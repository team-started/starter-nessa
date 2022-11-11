<?php

declare(strict_types=1);

namespace StarterTeam\StarterNessa\Updates;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

class CtaFieldMigration implements UpgradeWizardInterface
{
    protected string $table = 'tt_content';

    protected array $oldFieldNames = [
        'nessa_ctalink',
        'nessa_ctalink_text',
    ];

    protected array $newFieldNames = [
        'tx_starter_ctalink',
        'tx_starter_ctalink_text',
    ];

    public function getIdentifier(): string
    {
        return 'starterNessa_CtaFieldUpdateWizard';
    }

    public function getTitle(): string
    {
        return 'Migrate EXT:starter_nessa CTA fields';
    }

    public function getDescription(): string
    {
        return 'Migrate the EXT:starter_nessa CTA fields into EXT:starter CTA fields';
    }

    /**
     * @inheritDoc
     */
    public function executeUpdate(): bool
    {
        return $this->copyOldFieldValuesToNewFieldValues();
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function copyOldFieldValuesToNewFieldValues(): bool
    {
        foreach (array_keys($this->oldFieldNames) as $key) {
            $oldFieldName = $this->oldFieldNames[$key];
            $newFieldName = $this->newFieldNames[$key];

            if ($this->countOfFieldUpdates($oldFieldName) && $this->countOfFieldUpdates($newFieldName)) {
                $this->copyFieldData($oldFieldName, $newFieldName);
            }
        }

        return true;
    }

    /**
     * Copy the value from old field to the new field
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function copyFieldData(string $oldFieldName, string $newFieldName)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
        $queryBuilder
            ->update($this->table)
            ->set($newFieldName, $queryBuilder->quoteIdentifier($oldFieldName), false)
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->eq(
                        $newFieldName,
                        $queryBuilder->createNamedParameter('', \PDO::PARAM_STR)
                    ),
                    $queryBuilder->expr()->isNull($newFieldName)
                )
            )
            ->execute();
    }

    /**
     * Checks whether updates are required.
     *
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function updateNecessary(): bool
    {
        return (bool) $this->countOfFieldUpdates();
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    protected function countOfFieldUpdates(string $fieldName = ''): int
    {
        $fieldName = !empty($fieldName) ? $fieldName : $this->oldFieldNames[0];

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($this->table);
        $queryBuilder->getRestrictions()->removeAll();

        return $queryBuilder->count('uid')
            ->from($this->table)
            ->where(
                $queryBuilder->expr()->orX([$queryBuilder->expr()->eq(
                    $fieldName,
                    $queryBuilder->createNamedParameter('', \PDO::PARAM_STR)
                ), $queryBuilder->expr()->isNull($fieldName)])
            )
            ->execute()
            ->fetchOne(0);
    }
}
