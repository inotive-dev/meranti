<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\SettingQuotation;
use Illuminate\Http\Request;

class QuotationItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['quotation'] = Quotation::with('job_request.project.client')->findOrFail($request->quotation_id);
        $data['quotation_items'] = QuotationItem::whereDoesntHave('quotation_item_parent')->with('quotation_item_childs.quotation_item_childs')->where('quotation_id', $request->quotation_id)->get();
            $data['title'] = 'Quotation Item';

        return view('dashboard.quotation-item.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        QuotationItem::create([
            'quotation_id' => $request->quotation_id,
            'quotation_item_id' => $request->quotation_item_id,
            'name' => $request->name,
            'volume' => $request->volume,
            'unit_price' => $request->unit_price,
            'service' => $request->service,
            'material' => $request->material,
        ]);
        
        $QuotationItemParent = QuotationItem::find($request->quotation_item_id);
        if(!empty($QuotationItemParent))
        {
            $QuotationItemParent->update([
                'volume' => null,
                'unit_price' => null,
                'service' => null,
                'material' => null,
            ]);
        }
        
        return redirect()->back()->with('OK', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuotationItem  $QuotationItem
     * @return \Illuminate\Http\Response
     */
    public function show(QuotationItem $QuotationItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuotationItem  $QuotationItem
     * @return \Illuminate\Http\Response
     */
    public function edit(QuotationItem $QuotationItem)
    {
        return $QuotationItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuotationItem  $QuotationItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuotationItem $QuotationItem)
    {
        $QuotationItem->update([
            'quotation_item_id' => $request->quotation_item_id,
            'name' => $request->name,
            'volume' => $request->volume,
            'unit_price' => $request->unit_price,
            'service' => $request->service,
            'material' => $request->material,
        ]);
        
        if(!empty($request->quotation_item_id))
        {
            $childIds = QuotationItem::where('quotation_item_id', $QuotationItem->id)->pluck('id')->toArray();
            $subChildIds = QuotationItem::whereIn('quotation_item_id', $childIds)->pluck('id')->toArray();
            if(in_array($request->quotation_item_id, $childIds) || in_array($request->quotation_item_id, $subChildIds))
            {
                $subChildIds = QuotationItem::where('quotation_item_id', $QuotationItem->id)->update([
                    'quotation_item_id' => null
                ]);
            }
        }
        
        $QuotationItemParent = QuotationItem::find($request->quotation_item_id);
        if(!empty($QuotationItemParent))
        {
            $QuotationItemParent->update([
                'volume' => null,
                'unit_price' => null,
                'service' => null,
                'material' => null,
            ]);
        }
        
        return redirect()->back()->with('OK', 'Data berhasil diperbarui');
    }
    
    public function verification(Request $request)
    {
        if($request->quotation_id != null)
        {
            $t = Quotation::where('id', $request->id_quotation)->update([
               'verification' => 1
            ]);
            $quotationItems = QuotationItem::whereIn('id', $request->quotation_id)->update([
               'verification' => 1
            ]);
            
        }
        
        if($request->id_quotation != null)
        {
            if($request->quotation_client_id != null)
            {
                Quotation::where('id', $request->id_quotation)->update([
                  'verification_client' => 1
                ]);
                foreach($request->quotation_client_id as $item)
                {
                    $explodeId = explode('-', $item);
                    $quotationItem = QuotationItem::where('id', $explodeId[1])->first();
                    $quotationItem->update([
                       'verification_client' => 1
                    ]);
                    $quotationItem->job_request_item->update([
                       'remarks' => $explodeId[0]
                    ]);
                }
            }
        }
        
        return redirect()->back()->with('OK', 'Data berhasil di verifikasi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuotationItem  $QuotationItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuotationItem $QuotationItem)
    {
        $QuotationItem->delete();
        
        return redirect()->back()->with('OK', 'Data berhasil dihapus');
    }
}
