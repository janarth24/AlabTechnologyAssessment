<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\comments;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\products;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class taskcontroller extends Controller
{

    public function adminpage()
    {
        $users = User::all();
         $blogs = Blog::all();
        return view('admin', compact('users','blogs'));
    }
    public function index()
    {

        return view('home');
    }

    public function blog()
    {
        $blogs = Blog::with(['user', 'comments.user'])->latest()->get();
        return view('blog', compact('blogs'));
    }

    public function comment(Request $request)
    {
        $request->validate([

            'comment_content' => 'required|string|max:1000',
            'postid'          => 'required|integer|exists:blogs,id',
        ]);

        comments::create([
            'user_id'         => Auth::id(),
            'postid'          => $request->postid,
            'comment_content' => $request->comment_content,
        ]);

        return back()->with('success', 'Comment posted!');
    }

    public function post(Request $request)
    { 
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'postimage' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:50000',
        ]);

        $imageName = '';


        if ($request->hasFile('postimage')) {
            $imageName = time() . '.' . $request->postimage->extension();
            $request->postimage->move(public_path('images'), $imageName);
        }
        $post = blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'postimage' => $imageName,
        ]);

        return back()->with('success', 'posted successfully!');
    }

    public function ecommerce()
    {

        $products = products::where('stock', '>', 10)->get();
        $orders = Order::all();


        return view('ecommerce', compact('products', 'orders'));
    }
    public function markAsReceived($id)
    {
        $order = Order::with('items')->findOrFail($id);

        if (strtolower($order->status) !== 'completed') {

            $order->status = 'Completed';
            $order->save();


            foreach ($order->items as $item) {
                $product = products::find($item->product_id);

                if ($product && $product->stock >= $item->quantity) {
                    $product->decrement('stock', $item->quantity);
                }
            }
        }

        return back()->with('success', 'Order marked as received and stock updated.');
    }
    public function viewUsers()
    {
        return view('users');
    }

    // public function ajaxUsers(Request $request)
    // {
    //     try {
    //         $response = Http::get('https://jsonplaceholder.typicode.com/users');

    //         if (!$response->successful()) {
    //             return response()->json(['error' => 'Failed to fetch data.'], 500);
    //         }

    //         $users = $response->json();

    //         if ($request->has('search')) {
    //             $search = strtolower($request->input('search'));
    //             $users = array_filter($users, function ($user) use ($search) {
    //                 return str_contains(strtolower($user['name']), $search);
    //             });
    //         }

    //         return response()->json(array_values($users));
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'API error.'], 500);
    //     }
    // }
     public function deleteuser($id)
    {
       
        $User = User::find($id);
        if ($User) {
            $User->delete();
            return back()->with('success', 'User deleted successfully');
        } else {
            return back()->with('error', 'User not found');
        }
    }

    public function deletepost($id)
    {
       
        $Blog = Blog::find($id);
        if ($Blog) {
            $Blog->delete();
            return back()->with('success', 'blog deleted successfully');
        } else {
            return back()->with('error', 'blog not found');
        }
    }


    public function updatename(Request $request, $id)
    {
        $request->validate([
            'requestname' => 'required|string|max:255',
        ]);
        User::where('id', $id)->update([
            'name' => $request->requestname,
        ]);

        return back()->with('success', 'User name updated successfully!');
    }

    public function fetchUsers(Request $request)
    {
        try {
            $response = Http::get('https://jsonplaceholder.typicode.com/users');
            
            if (!$response->successful()) {
                return view('sample', ['sample' => [], 'error' => 'Failed to fetch data from API.']);
            }
            
            $users = $response->json();
            dd($users);

            // Filter by name if search query is provided
            if ($request->has('search')) {
                $search = strtolower($request->input('search'));
                $users = array_filter($users, function ($user) use ($search) {
                    return str_contains(strtolower($user['name']), $search);
                });
            }

            return view('sample', ['users' => $users, 'error' => null]);

        } catch (\Exception $e) {
            return view('sample', ['users' => [], 'error' => 'Something went wrong while calling the API.']);
        }
    }
}
