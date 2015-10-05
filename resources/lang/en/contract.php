<?php
/*
|--------------------------------------------------------------------------
| Contract Keyword
|--------------------------------------------------------------------------
|
*/

return [
    'add'                           => "Add Contract",
    'whoops'                        => "Whoops!",
    'problem'                       => "There were some problems with your input.",
    'select_pdf'                    => "Select PDF",
    'pdf_only'                      => "PDF file only.",
    'language'                      => "Language",
    'country'                       => "Country",
    'resource'                      => "Resource",
    'government_entity'             => "Government Entity",
    'government_identifier'         => "Government Identifier",
    'type_of_contract'              => "Type of Contract",
    'signature_date'                => "Signature Date",
    'document_type'                 => "Document Type",
    'translation_from_original'     => "Translation from Original",
    'translation_parent'            => "Translation Parent",
    'company'                       => "Company",
    'company_name'                  => "Company Name",
    'jurisdiction_of_incorporation' => "Jurisdiction of Incorporation",
    'registry_agency'               => "Registration Agency",
    'incorporation_date'            => "Incorporation Date",
    'company_address'               => "Company Address",
    'company_number'                => "Company Number",
    'corporate_grouping'            => "Corporate Grouping",
    'open_corporate'                => "OpenCorporates Link",
    'license_and_project'           => "Concession / License and Project",
    'license_name'                  => "Concession / License Name",
    'license_identifier'            => "Concession / License Identifier",
    'project_title'                 => "Project Title",
    'project_identifier'            => "Project Identifier",
    'source'                        => "Source",
    'source_url'                    => "Source URL",
    'date_of_retrieval'             => "Date of Retrieval",
    'category'                      => "Category",
    'open_land_contracts'           => "OpenLandContracts",
    'resource_contract_org'         => "ResourceContracts.org",
    'submit'                        => "Submit",
    'all_contract'                  => "All Contracts",
    'contract_not_found'            => "Contract not found",
    'download_file'                 => "Download file",
    'year'                          => "Year",
    'search'                        => "Search",
    'delete'                        => "Delete",
    'confirm_delete'                => "Are you sure you want to delete this contract?",
    'annotate'                      => "Annotate",
    'view_pages'                    => "Review Contract Text",
    'pdf_type'                      => "Pdf Type:",
    'choose'                        => "Choose",
    'acceptable'                    => "Acceptable",
    'needs_editing'                 => "Needs Editing",
    'needs_full_transcription'      => "Needs Full Transcription",
    'close'                         => "Close",
    'save_changes'                  => "Save change",
    'created_on'                    => "Created on",
    'parent_company'                => "Parent Company",
    'license_type'                  => "License Type",
    'license_source_url'            => "License Source url",
    'annotations'                   => "Annotations",
    'edit'                          => "Edit",
    'resource_contracts'            => "Resource Contracts",
    'logout'                        => "Logout",
    'contract_name'                 => "Contract Name",
    'contract_identifier'           => "Contract Identifier",
    'contract_file'                 => "Contract File",
    'annotate_contract'             => "Annotate Contract",
    'editing'                       => "Editing",
    'created_by'                    => "Created By",
    'last_modified_by'              => "Last modified by",
    'status'                        => "Status",
    'license_name_only'             => "License Name",
    'license_identifier_only'       => "License Identifier",
    'pipeline'                      => "Pipeline",
    'processing'                    => "Processing",
    'annotation_list'               => "Annotation List",
    'users'                         => 'Users',
    /*ContractController*/
    'save_success'                  => 'Contract successfully uploaded. You will receive an email notification once the contract processing is complete allowing for the text review',
    'save_fail'                     => 'Contract could not be saved.',
    'update_success'                => 'Contract successfully updated.',
    'update_fail'                   => 'Contract could not be updated.',
    'delete_success'                => 'Contract successfully deleted.',
    'delete_fail'                   => 'Contract could not be deleted.',
    'saved'                         => 'Changes Saved.',
    'not_updated'                   => 'Could not be updated.',
    'status_update'                 => 'Contract status successfully updated.',
    'invalid_status'                => 'Invalid Status',
    'permission_denied'             => 'Permission Denied.',
    'status_updated'                => 'Contract status successfully updated.',
    'disclosure_mode'               => "Disclosure Mode",
    'participation_share'           => "Participation Share",
    'amla'                          => "Current mining legislation at AMLA",
    'review_text'                   => "Review Text",
    'edit_metadata'                 => "Edit Metadata",
    'is_operator'                   => "Is Operator?",
    'operator'                      => 'Operator',
    'translated_from'               => 'Translated From',
    'supporting_documents'          => 'Supporting Documents',
    'parent_document'               => 'Parent Document',
    'associated_contracts'          => 'Associated Documents',
    'fail_status'                   => 'Pdf file is :status',
    'show_pdf_text'                 => 'Show Pdf Text',
    'text_type'                     => 'Text Type',
    /*Logs*/
    'log'                           => [
        'save'      => 'Contract created',
        'update'    => 'Contract updated',
        'delete'    => 'Contract ":contract" deleted',
        'status'    => 'Contract :type status updated from :old_status to :new_status',
        'save_page' => 'Page no :page updated',
        'unpublish' => 'Unpublished',
    ],
    'page'                          => [
        'save'      => 'Your corrections / changes have been saved',
        'save_fail' => 'Changes couldn\'t be saved',
    ],
    'publish'                       => [
        'all'     => 'Publish All',
        'confirm' => 'Publish All ?'
    ],
    'unpublish'                     => [
        'all'     => 'Unpublish',
        'success' => 'Contract has been successfully unpublish.',
        'fail'    => 'Error unpublishing this contract.',
        'confirm' => 'Unpublish this contract ?'
    ],
    'import'                        => [
        'name'           => "Import Contract",
        'title'          => "Open Oil Contract Import",
        'file'           => 'CSV or Excel file',
        'help'           => 'Please make sure that the csv file follows the following :format',
        'exist'          => 'The contract file is already present in our system :link',
        'status'         => 'Open Oil Contract Import Status',
        'sn'             => 'SN',
        'file_name'      => 'File Name',
        'contract_title' => 'Open Oil Contract Title',
        'status_name'    => 'status',
        'remarks'        => 'Remarks',
        'pending'        => 'Pending',
        'processing'     => 'Processing',
        'completed'      => 'Completed',
        'failed'         => 'Failed',
        'created_date'   => 'Created Date',
        'upload_another' => 'Upload another file',
        'btn_import'     => 'Import',
        'btn_cancel'     => 'Cancel and upload another file',
        'fail'           => 'Could not found any contract to import.'
    ]
];
