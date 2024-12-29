<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FarmingNeed;
use Illuminate\Support\Facades\Auth;

class FarmingNeedsController extends Controller
{
    public function index()
    {
        $farmingNeeds = FarmingNeed::where('mitra_id', Auth::id())->get();
        return view('mitra.check_store', ['farmingNeeds' => $farmingNeeds]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'item_type' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000', 
            'stock' => 'required|integer|min:0', 
            'price' => 'required|numeric|min:0', 
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', 
            'discount' => 'required|integer|min:0|max:100',
        ]);

        $farmingNeed = new FarmingNeed();
        $farmingNeed->mitra_id = Auth::id();
        $farmingNeed->item_type = $request->item_type;
        $farmingNeed->item_name = $request->item_name;
        $farmingNeed->description = $request->description;
        $farmingNeed->stock = $request->stock;
        $farmingNeed->price = $request->price;
        $farmingNeed->discount = $request->discount;
        $farmingNeed->rating = rand(35, 46) / 10;


        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images'), $filename);
            $farmingNeed->photo = $filename;
        }

        try {
            $farmingNeed->save();
            return redirect()->route('mitra.check_store')->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            return redirect()->route('mitra.check_store')->with('error', 'Error adding product: ' . $e->getMessage());
        }
    }

    public function detail($id)
    {
        $product = FarmingNeed::findOrFail($id);
        return view('mitra.detail_product', compact('product'));
    }
    

    public function update(Request $request, $id)
    {
        $product = FarmingNeed::findOrFail($id);
    
        $data = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $filename);
            $data['photo'] = $filename;
        }
    
        $product->update($data);
    
        return redirect()->route('mitra.check_store')->with('success', 'Produk berhasil diperbarui.');
    }    

    public function destroy(string $id)
    {
        $farmingNeed = FarmingNeed::find($id);
    
        if (!$farmingNeed) {
            return redirect()->route('mitra.check_store')->with('error', 'Produk tidak ditemukan.');
        }
    
        $farmingNeed->delete();
        return redirect()->route('mitra.check_store')->with('success', 'Produk berhasil dihapus.');
    }
    
}
