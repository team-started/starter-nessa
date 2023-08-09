<?php

declare(strict_types=1);

namespace StarterTeam\StarterNessa\Updates;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

class CeDownloadMigration implements UpgradeWizardInterface
{
    public function getIdentifier(): string
    {
        return 'starterNessa_ContentElementDownloadListUpdateWizard';
    }

    public function getTitle(): string
    {
        return 'Migrate EXT:starter_nessa content element "nessa_download_list"';
    }

    public function getDescription(): string
    {
        return 'Migrate the EXT:starter_nessa content element "nessa_download_list" into EXT:starter "starter_download" content element';
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');
        $queryBuilder
            ->update('tt_content')
            ->set('CType', 'starter_download')
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('nessa_download_list'))
            )
            ->execute();

        return true;
    }

    /**
     * Checks whether updates are required.
     */
    public function updateNecessary(): bool
    {
        return (bool)$this->countAvailableContentElements();
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    protected function countAvailableContentElements(): int
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');

        $queryBuilder->getRestrictions()->removeAll();
        $result = $queryBuilder
            ->count('uid')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('nessa_download_list'))
            )
            ->execute()
            ->fetchOne();

        if (is_int($result)) {
            return $result;
        }

        return 0;
    }
}
