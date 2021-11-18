<?php

namespace StarterTeam\StarterNessa\DataProcessing;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Class AssetsOfCategoriesProcessor
 */
class AssetsOfCategoriesProcessor implements DataProcessorInterface
{
    /**
     * @var ContentDataProcessor
     */
    protected $contentDataProcessor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentDataProcessor = GeneralUtility::makeInstance(ContentDataProcessor::class);
    }

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        /**@var ResourceFactory $resourceFactory*/
        $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);

        // The variable to be used within the result
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'portfolioAssets');

        $categories = [];
        if (!empty($processedData['portfolioCategories'])) {
            foreach ($processedData['portfolioCategories'] as $category) {
                array_push($categories, $category['data']['uid']);
            }
        }

        if (empty($categories)) {
            return $processedData;
        }

        $fileRecords = $this->getRecords(
            $categories,
            $cObj->stdWrapValue('sorting', $processorConfiguration, 'name')
        );

        $categoriesWithData = [];
        if (!empty($fileRecords)) {
            foreach ($fileRecords as $record) {
                $processedData[$targetVariableName][] = [
                    'file' => $resourceFactory->getFileObject($record['uid']),
                    'category' => [
                        'uid' => $record['categoryUid'],
                        'title' => $record['title'],
                    ],
                ];
                array_push($categoriesWithData, $record['categoryUid']);
            }
        }

        $result = array_unique($categoriesWithData);
        foreach ($processedData['portfolioCategories'] as $index => $resultItem) {
            $processedData['portfolioCategories'][$index]['assetsAvailable'] = false;
            if (in_array($resultItem['data']['uid'], $result)) {
                $processedData['portfolioCategories'][$index]['assetsAvailable'] = true;
            }
        }
        return $processedData;
    }

    protected function getRecords(array $category, string $sorting = 'name'): array
    {
        /**@var $queryBuilder QueryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_file');

        $statement = $queryBuilder
            ->select('sys_file.uid', 'sys_category.title', 'sys_category.uid as categoryUid')
            ->from('sys_file')
            ->join(
                'sys_file',
                'sys_file_metadata',
                'sys_file_metadata',
                $queryBuilder->expr()->eq(
                    'sys_file_metadata.file',
                    $queryBuilder->quoteIdentifier('sys_file.uid')
                )
            )
            ->join(
                'sys_file_metadata',
                'sys_category_record_mm',
                'sys_category_record_mm',
                $queryBuilder->expr()->eq(
                    'sys_category_record_mm.uid_foreign',
                    $queryBuilder->quoteIdentifier('sys_file_metadata.uid')
                )
            )
            ->join(
                'sys_category_record_mm',
                'sys_category',
                'sys_category',
                $queryBuilder->expr()->eq(
                    'sys_category.uid',
                    $queryBuilder->quoteIdentifier('sys_category_record_mm.uid_local')
                )
            )
            ->where(
                $queryBuilder->expr()->in('sys_category_record_mm.uid_local', $category),
                $queryBuilder->expr()->eq(
                    'sys_category_record_mm.tablenames',
                    $queryBuilder->quote('sys_file_metadata')
                )
            )
            ->orderBy('sys_file.' . $sorting)
            ->execute()
            ->fetchAllAssociative();

        return $statement;
    }
}
