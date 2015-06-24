<?php namespace App\Http\Controllers\Contract\Page;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Nrgi\Entities\Contract\Contract;
use App\Nrgi\Services\Contract\ContractService;
use App\Nrgi\Services\Contract\AnnotationService;
use App\Nrgi\Services\Contract\Pages\PagesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class PageController
 * @package App\Http\Controllers\Contract\Page
 */
class PageController extends Controller
{
    /**
     * @var ContractService
     */
    protected $contract;
    /**
     * @var PagesService
     */
    protected $pages;

    /**
     * @param ContractService $contract
     * @param PagesService    $pages
     */
    public function __construct(ContractService $contract, PagesService $pages, AnnotationService $annotation)
    {
        $this->middleware('auth');
        $this->contract = $contract;
        $this->pages    = $pages;
        $this->annotation = $annotation;
    }

    /**
     * Display Contact Pages
     *
     * @return Response
     */
    public function index(Request $request, $contractId)
    {
        $page        = $this->pages->getText($contractId, $request->input('page', '1'));
        $action      = $request->input('action', '');
        $canEdit     = $action == "edit" ? 'true' : 'false';
        $canAnnotate = $action == "annotate" ? 'true' : 'false';
        $contract    = $this->contract->findWithPages($contractId);
        $pages       = $contract->pages;

        return view('contract.page.index', compact('contract', 'pages', 'page', 'canEdit', 'canAnnotate'));
    }

    public function compare(Request $request, $contractId1, $contractId2)
    {
        $page        = $this->pages->getText($contractId1, $request->input('page', '1'));
        $action      = $request->input('action', '');
        $canEdit     = $action == "edit" ? 'true' : 'false';
        $canAnnotate = $action == "annotate" ? 'true' : 'false';
        $contract    = $this->contract->findWithPages($contractId1);
        $pages       = $contract->pages;

        $contract1Meta    = $this->contract->findWithPages($contractId1);
        $contract1AnnotationsObj = $this->annotation->getContractPagesWithAnnotations($contractId1);
        $contract1Annotations = [];    
        foreach($contract1AnnotationsObj->annotations as $annotation) {
            $tags = [];
            foreach($annotation->annotation->tags as $tag) {
                $tags[] = $tag;
            }
            $contract1Annotations[] = ['page'=>$annotation->document_page_no,
                'quote'=>$annotation->annotation->quote,
                'text'=>$annotation->annotation->text,
                'tags'=>$tags];
        }

        $contract2Meta    = $this->contract->findWithPages($contractId2);
        $contract2AnnotationsObj = $this->annotation->getContractPagesWithAnnotations($contractId2);
        $contract2Annotations = [];    
        foreach($contract2AnnotationsObj->annotations as $annotation) {
            $tags = [];
            foreach($annotation->annotation->tags as $tag) {
                $tags[] = $tag;
            }
            $contract2Annotations[] = ['page'=>$annotation->document_page_no,
                'quote'=>$annotation->annotation->quote,
                'text'=>$annotation->annotation->text,
                'tags'=>$tags];
        }

        $contract1 = array('metadata'=>$contract1Meta, 
                           'pages'=>$contract1Meta->pages,
                           'annotations'=>$contract1Annotations);
        $contract2 = array('metadata'=>$contract2Meta, 
                           'pages'=>$contract2Meta->pages,
                           'annotations'=>$contract2Annotations);        

        return view('contract.page.compare', compact('contract', 'contract1', 'contract2', 'pages', 'page', 'canEdit', 'canAnnotate'));
    }

    /**
     * Save Page text
     * @param         $id
     * @param Request $request
     * @return int
     */
    public function store($id, Request $request, ContractService $contract)
    {
        if ($this->pages->saveText($id, $request->input('page'), $request->input('text'))) {
            $contract              = $contract->find($id);
            $contract->text_status = Contract::STATUS_DRAFT;
            $contract->save();

            return response()->json(['result' => 'success', 'message' => 'saved']);
        }

        return response()->json(['result' => 'fail', 'message' => 'Something went wrong.']);
    }

    /**
     * Get Page Text
     * @param         $contractID
     * @param Request $request
     * @return mixed
     */
    public function getText($contractID, Request $request)
    {
        $page = $this->pages->getText($contractID, $request->input('page'));

        return response()->json(['result' => 'success', 'message' => $page->text]);
    }
}
