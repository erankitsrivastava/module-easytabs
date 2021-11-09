<?php

namespace Swissup\Easytabs\Ui\Component\Listing\Column;

/**
 * The purpose of this class is adding value of invisible 'is_active_label'
 */
class Status extends \Magento\Ui\Component\Listing\Columns\Column
{
    /** Status column name used to get its column value */
    const SOURCE_FIELD_NAME = 'status';

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        $fieldName = $this->getData('name');

        foreach ($dataSource['data']['items'] as &$item) {
            if (isset($item[self::SOURCE_FIELD_NAME])) {
                $item[$fieldName] = $this->getOptionText($item[self::SOURCE_FIELD_NAME]);
            }
        }

        return $dataSource;
    }

    /**
     * Returns option text by option value
     *
     * @param int $item
     * @return string|null
     */
    private function getOptionText($item)
    {
        $statusesArray = [
            \Magento\Cms\Model\Block::STATUS_ENABLED => __('Active'),
            \Magento\Cms\Model\Block::STATUS_DISABLED => __('Inactive')
        ];
        return isset($statusesArray[$item]) ? $statusesArray[$item]: null;
    }
}
