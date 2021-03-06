<?php namespace App\Nrgi\Services\Download;

use App\Nrgi\Services\Contract\Annotation\AnnotationService;
use GuzzleHttp\Client;
use App\Nrgi\Services\Contract\ContractService;
use Maatwebsite\Excel\Excel;

/**
 * Class APIService
 * @package App\Http\Services
 */
class DownloadService
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Excel
     */
    protected $excel;

    /**
     * @param Client            $client
     * @param ContractService   $contractService
     * @param AnnotationService $annotationService
     * @param Excel             $excel
     */
    public function __construct(Client $client, ContractService $contractService, AnnotationService $annotationService, Excel $excel)
    {
        $this->client            = $client;
        $this->contractService   = $contractService;
        $this->annotationService = $annotationService;
        $this->excel             = $excel;
    }

    /**
     * Download as CSV
     *
     * @param $contracts
     */
    public function downloadData($contracts)
    {
        $data = [];
        foreach ($contracts as $contract) {
            $data[] = $this->getCSVData($contract);

        }

        $filename = "export" . date('Y-m-d');

        $this->excel->create(
            $filename,
            function ($csv) use (&$data) {
                $csv->sheet(
                    'sheetname',
                    function ($sheet) use (&$data) {
                        $sheet->fromArray($data);
                    }
                );
            }
        )->download('xls');
    }

    /**
     * Format all the contracts data
     *
     * @param $contracts
     * @return array
     */
    private function formatCSVData($contracts)
    {
        $data = [];
        foreach ($contracts as $contract) {
            $data[] = $this->getCSVData($contract);
        }

        return $data;
    }

    /**
     * Return the format of csv
     *
     * @param       $contract
     * @return array
     *
     *     */
    private function getCSVData($contract)
    {
        return [
            'Contract ID'                   => $contract->id,
            'OCID'                          => $contract->metadata->open_contracting_id,
            'Category'                      => join(';', $contract->metadata->category),
            'Contract Name'                 => $contract->metadata->contract_name,
            'Contract Identifier'           => $contract->metadata->contract_identifier,
            'Language'                      => $contract->metadata->language,
            'Country Name'                  => $contract->metadata->country->name,
            'Resource'                      => implode(';', $contract->metadata->resource),
            'Contract Type'                 => implode(';', $contract->metadata->type_of_contract),
            'Signature Date'                => $contract->metadata->signature_date,
            'Document Type'                 => $contract->metadata->document_type,
            'Government Entity'             => implode(';', $this->makeSemicolonSeparated($contract->metadata->government_entity, 'entity')),
            'Government Identifier'         => implode(';', $this->makeSemicolonSeparated($contract->metadata->government_entity, 'identifier')),
            'Company Name'                  => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'name')),
            'Jurisdiction of Incorporation' => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'jurisdiction_of_incorporation')),
            'Registration Agency'           => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'registration_agency')),
            'Company Number'                => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'company_number')),
            'Company Address'               => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'company_address')),
            'Participation Share'           => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'participation_share')),
            'Corporate Grouping'            => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'parent_company')),
            'Open Corporates Link'          => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'open_corporate_id')),
            'Incorporation Date'            => implode(';', $this->makeSemicolonSeparated($contract->metadata->company, 'company_founding_date')),
            'Operator'                      => implode(';', $this->getOperator($contract->metadata->company, 'operator')),
            'Project Title'                 => $contract->metadata->project_title,
            'Project Identifier'            => $contract->metadata->project_identifier,
            'License Name'                  => implode(';', $this->makeSemicolonSeparated($contract->metadata->concession, 'license_name')),
            'License Identifier'            => implode(';', $this->makeSemicolonSeparated($contract->metadata->concession, 'license_identifier')),
            'Source Url'                    => $contract->metadata->source_url,
            'Disclosure Mode'               => $contract->metadata->disclosure_mode,
            'Retrieval Date'                => $contract->metadata->date_retrieval,
            'Pdf Url'                       => $contract->metadata->file_url,
            'Associated Documents'          => implode(';', $this->getSupportingDoc($contract->id)),
            'Pdf Type'                      => $contract->pdf_structure,
            'Show Pdf Text'                 => $this->getShowPDFText($contract->metadata->show_pdf_text),
            'Text Type'                     => $this->getTextType($contract->textType),
            'Metadata Status'               => $contract->metadata_status,
            'Annotation Status'             => $this->annotationService->getStatus($contract->id),
            'Pdf Text Status'               => $contract->text_status,
            'Created by'                    => $contract->created_user()->first()->name,
            'Created on'                    => $contract->created_datetime,
        ];
    }

    /**
     * Make the array semicolon separated for multiple data
     *
     * @param $arrays
     * @param $key
     * @return array
     */
    private function makeSemicolonSeparated($arrays, $key)
    {
        $data = [];
        if ($arrays == null) {
            return $data;
        }
        foreach ($arrays as $array) {
            if (is_array($array) && array_key_exists($array, $key)) {
                array_push($data, $array[$key]);
            }
            if (is_object($array) && property_exists($array, $key)) {
                array_push($data, $array->$key);
            }
        }

        return $data;
    }

    /**
     * Return the operator
     *
     * @param $company
     * @return array
     */
    private function getOperator($company)
    {
        $data     = [];
        $operator = trans('operator');

        foreach ($company as $companyData) {
            if (isset($companyData->operator) && $companyData->operator) {
                array_push($data, $operator[$companyData->operator]);
            }
        }

        return $data;
    }

    /**
     * Return the Text Type for each contract
     *
     * @param $id
     * @return string
     */
    public function getTextType($id)
    {
        if ($id == 1) {
            return "Structured";
        } else {
            if ($id == 2) {
                return "Needs Editing";
            } else {
                if ($id == 3) {
                    return "Needs Full Transcription";
                }
            }
        }
    }

    /**
     * Get Supporting Documents for each contract.
     *
     * @param $id
     * @return array
     */
    public function getSupportingDoc($id)
    {
        $supportingDocs = $this->contractService->getSupportingDocuments($id);
        $supportingDoc  = [];
        foreach ($supportingDocs as $support) {
            array_push($supportingDoc, $support['id']);
        }

        return $supportingDoc;
    }

    /**
     * Get Show PDF Text Status
     *
     * @param $status
     * @return string
     */
    public function getShowPDFText($status)
    {
        if ($status == '0') {
            return "No";
        } else {
            return "Yes";
        }
    }
}
