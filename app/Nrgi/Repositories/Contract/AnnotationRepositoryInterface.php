<?php
namespace App\Nrgi\Repositories\Contract;

/**
 * Interface ContractAnnotationRepositoryInterface
 * @package Nrgi\Repositories\Contract
 */
interface AnnotationRepositoryInterface
{
    /**
     * Save or update contract annotation
     * @param  $contractAnnotationData
     * @return bool
     */
    public function save($contractAnnotationData);

    /**
     * Delete a annotation.
     *
     * @param  int $id
     * @return bool|null
     */
    public function delete($id);

    /**
     * Search
     * @param $params
     * @return Annotation
     */
    public function search(array $params);

    /**
     * contract with pages and pages with annotations
     *
     * @param $contractId
     * @return contract
     */
    public function getContractPagesWithAnnotations($contractId);

    /**
     * updates contract annotation status
     * @param $status
     * @param $contractId
     * @return bool
     */
    public function updateStatus($status, $contractId);

    /**
     * annotation status by contract id
     *
     * @param $contractId
     * @return string
     */
    public function getStatus($contractId);

    /**
     * Get Total Annotation status by type
     * @param $statusType
     * @return array
     */
    public function getStatusCountByType($statusType);

    /**
     * update annotation category or text
     * @param       $id
     * @param array $data
     * @return bool
     */
    public function updateAnnotationField($id, array $data);

    /**
     * find annotation by id
     * @param $id
     * @return Annotation
     */
    public function getById($id);

    /**
     * Get the count of presence of annotation's category
     *
     * @param $key
     * @return array
     */
    public function getAnnotationsQuality($key);
}
