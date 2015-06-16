@section('script')
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/bootstrap-datepicker3.min')}}"/>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/contract.js')}}"></script>
@stop

@section('css')
    <style>
        .select2-search__field {width: 100% !important;}
        .red {color:red}
    </style>
    @stop

@if($action == 'add')
    <div class="form-group">
        <label for="Select PDF" class="col-sm-2 control-label">@lang('contract.contract_file') <span class="red">*</span></label>

        <div class="col-sm-7">
            {!! Form::file('file', ['class'=>'required'])!!}
            <p class="help-block">@lang('contract.pdf_only').</p>
        </div>
    </div>
@endif

<div class="form-group">
    <label for="contract_name" class="col-sm-2 control-label">@lang('contract.contract_name') <span class="red">*</span></label>
    <div class="col-sm-7">
        {!! Form::text('contract_name',
        isset($contract->metadata->contract_name)?$contract->metadata->contract_name:null,
        ["class"=>"required form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('contract_identifier', trans('contract.contract_identifier'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('contract_identifier',
        isset($contract->metadata->contract_identifier)?$contract->metadata->contract_identifier:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('language', trans('contract.language'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::select('language', trans('codelist/language'),
        isset($contract->metadata->language)?$contract->metadata->language:null, ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    <label for="country" class="col-sm-2 control-label">@lang('contract.country') <span class="red">*</span></label>
    <div class="col-sm-7">
        {!! Form::select('country', ['' => 'select'] + $country ,
        isset($contract->metadata->country->code)?$contract->metadata->country->code:null, ["class"=>"required form-control"])!!}
        <label id="country-error" class="error" for="country"></label>
    </div>
</div>

<div class="form-group">
    {!! Form::label('resource', trans('contract.resource'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::select('resource[]', trans('codelist/resource'),
        isset($contract->metadata->resource)?$contract->metadata->resource:null, ['multiple'=>'multiple',
        "class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('government_entity', trans('contract.government_entity'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('government_entity',
        isset($contract->metadata->government_entity)?$contract->metadata->government_entity:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('government_identifier', trans('contract.government_identifier'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('government_identifier',
        isset($contract->metadata->government_identifier)?$contract->metadata->government_identifier:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('type_of_contract', trans('contract.type_of_contract'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('type_of_contract',
        isset($contract->metadata->type_of_contract)?$contract->metadata->type_of_contract:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    <label for="signature_date" class="col-sm-2 control-label">@lang('contract.signature_date') <span class="red">*</span></label>
    <div class="col-sm-7">
        {!! Form::text('signature_date',
        isset($contract->metadata->signature_date)?$contract->metadata->signature_date:null,
        ["class"=>"date required form-control", 'placeholder' => 'YYYY-MM-DD'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('document_type', trans('contract.document_type'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::select('document_type', trans('codelist/documentType'),
        isset($contract->metadata->document_type)?$contract->metadata->document_type:null, ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('translation_from_original', trans('contract.translation_from_original'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        <label class="checkbox-inline">
            {!! Form::radio('translation_from_original','1',
            (isset($contract->metadata->translation_from_original) && (1 ==
            $contract->metadata->translation_from_original))? true : null, ['class'=>'translation'])!!}
            Yes
        </label>
        <label class="checkbox-inline">
            {!! Form::radio('translation_from_original', '0',
            (isset($contract->metadata->translation_from_original) && (0 ==
            $contract->metadata->translation_from_original))? true : null, ['class'=>'translation'])!!}
            No
        </label>
    </div>
</div>

<div class="form-group @if(isset($contract->metadata->translation_from_original) && $contract->metadata->translation_from_original !=1) hide @endif translation-parent">
    {!! Form::label('translation_parent', trans('contract.translation_parent'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('translation_parent',
        isset($contract->metadata->translation_parent)?$contract->metadata->translation_parent:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<h3>@lang('contract.company')</h3>
<hr/>
<div class="form-group">
    {!! Form::label('company_name', trans('contract.company_name'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text("company[0][name]",
        isset($contract->metadata->company[0]->name)?$contract->metadata->company[0]->name:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('jurisdiction_of_incorporation', trans('contract.jurisdiction_of_incorporation'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text("company[0][jurisdiction_of_incorporation]",
        isset($contract->metadata->company[0]->jurisdiction_of_incorporation)?$contract->metadata->company[0]->jurisdiction_of_incorporation:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('registration_agency', trans('contract.registry_agency'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text("company[0][registration_agency]",
        isset($contract->metadata->company[0]->registration_agency)?$contract->metadata->company[0]->registration_agency:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('incorporation_date', trans('contract.incorporation_date'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text("company[0][company_founding_date]",
        isset($contract->metadata->company[0]->company_founding_date)?$contract->metadata->company[0]->company_founding_date:null,
        ["class"=>"date form-control", 'placeholder' => 'YYYY-MM-DD'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('company_address', trans('contract.company_address'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text("company[0][company_address]",
        isset($contract->metadata->company[0]->company_address)?$contract->metadata->company[0]->company_address:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('comp_id', trans('contract.identifier_at_company'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text("company[0][comp_id]",
        isset($contract->metadata->company[0]->comp_id)?$contract->metadata->company[0]->comp_id:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('parent_company', trans('contract.corporate_grouping'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text("company[0][parent_company]",
        isset($contract->metadata->company[0]->parent_company)?$contract->metadata->company[0]->parent_company:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    <a href="http://opencorporates.com" target="_blank"><i class="glyphicon glyphicon-link"></i> {!!
        Form::label('open_corporate_id',trans('contract.open_corporate_id'), ['class'=>'col-sm-2 control-label'])!!}</a>

    <div class="col-sm-7">
        {!! Form::text("company[0][open_corporate_id]",
        isset($contract->metadata->company[0]->open_corporate_id)?$contract->metadata->company[0]->open_corporate_id:null,
        ["class"=>"digit form-control"])!!}
    </div>
</div>

<h3>@lang('contract.license_and_project')</h3>
<hr/>

<div class="form-group">
    {!! Form::label('license_name', trans('contract.license_name'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('license_name',
        isset($contract->metadata->license_name)?$contract->metadata->license_name:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('license_identifier', trans('contract.license_identifier'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('license_identifier',
        isset($contract->metadata->license_identifier)?$contract->metadata->license_identifier:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('project_title', trans('contract.project_title'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('project_title',
        isset($contract->metadata->project_title)?$contract->metadata->project_title:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('project_identifier', trans('contract.identifier'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('project_identifier',
        isset($contract->metadata->project_identifier)?$contract->metadata->project_identifier:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<h3>Source</h3>
<hr/>

<div class="form-group">
    {!! Form::label('Source_url', trans('contract.source_url'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('Source_url',
        isset($contract->metadata->Source_url)?$contract->metadata->Source_url:null,
        ["class"=>"form-control"])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('date_retrieval', trans('contract.date_of_retrieval'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        {!! Form::text('date_retrieval',
        isset($contract->metadata->date_retrieval)?$contract->metadata->date_retrieval:null,
        ["class"=>"date form-control", 'placeholder' => 'YYYY-MM-DD'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('category', trans('contract.category'), ['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-7">
        @foreach(config('metadata.category') as $key => $category)
            <label class="checkbox-inline">
                {!! Form::checkbox('category[]', $key,
                (isset($contract->metadata->category) && is_array($contract->metadata->category) && in_array($key,
                $contract->metadata->category))? true : null)!!}
                {{$category}}
            </label>
        @endforeach
    </div>
</div>

<div class="form-action">
    <div class="col-sm-7 col-lg-offset-2">
        {!! Form::submit(trans('contract.submit'),['class'=>'btn btn-lg pull-right btn-primary']) !!}
    </div>
</div>
