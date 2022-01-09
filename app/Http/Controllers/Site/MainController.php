<?php

namespace App\Http\Controllers\Site;


use App\Models\Show;
use App\Models\User;
use App\Models\Episode;
use App\Models\Purchase;
use App\Models\EpisodeRate;
use App\Models\ShowFollower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Support\Facades\Hash;


class MainController extends Controller
{
    public function home()
    {
        $data['episodes'] = Episode::latest()->paginate(12);
    	return view('site.home', $data);
    }

    public function profile()
    {
        $user = auth()->user();
        $data['user'] = User::with('purchases')->withCount('purchases')->find(auth()->id());

    	return view('site.profile', $data);
    }

    public function update_profile(Request $request)
    {
        $user = auth()->user();
        $inputs = $request->validate([
    		'image' => 'sometimes|required|image|mimes:jpeg,png,jpg',
            'name' => 'required|max:191',
    		'email' => 'required|email|unique:users,email,'.$user->id
        ]);

        $user->update($inputs);

    	return back()->with(['successMessage' => 'Updated Successfully']);
    }

    public function update_password(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'old_password' => 'required|min:6|max:191',
            'password'      => 'required|min:6|max:191|confirmed'
        ]);
        if(!Hash::check(request('old_password'), $user->password)) {return back()->with(['errorMessage' => 'Old Password is not correct']);}
        $user->update(['password' => $request->password]);
    	return back()->with(['successMessage' => 'Updated Password Successfully']);
    }

    public function purchase()
    {
        $user = auth()->user();
        $data['user'] = User::with('purchases')->withCount('purchases')->find(auth()->id());
        $data['purchases'] = $user->purchases;

    	return view('site.purchase', $data);
    }
    public function purchase_show($id)
    {
        $user = auth()->user();
        $price = Show::findOrFail($id)->price;

        if($price > $user->my_money){ return back(); }

        $gift = $user->gift;

        if(!empty($gift)){

            $gift_amount = $user->gift->amount??0;
            $price = $price - $gift_amount;
            $gift->decrement('amount', $gift_amount);
        }

        if($price > 0){$user->decrement('wallet', $price);}

        Purchase::create(['user_id' => $user->id, 'show_id' => $id]);

        return redirect()->route('site.purchase');
    }

    public function wallet()
    {
        $user = auth()->user();
        $data['user'] = User::with('purchases')->withCount('purchases')->find(auth()->id());

    	return view('site.wallet', $data);
    }
    public function charge_wallet(Request $request)
    {

        $user = auth()->user();

        $request->validate([
            "card_number" => "required|min:16",
            "name" => "required|max:191",
            "expiry_date" => "required",
            "csv" => "required|min:3",
            "amount" => "required",
        ]);

        $user->update(['wallet' => $request->amount]);
    	return back()->with(['successMessage' => 'Updated Password Successfully']);
    }

    public function show($id)
    {
        $data['show'] = Show::with('episodes')->findOrFail($id);
        $data['followers'] = ShowFollower::where('show_id', $id)->get()->pluck('user_id')->toArray();
        $data['purchasers'] = Purchase::where('show_id', $id)->get()->pluck('user_id')->toArray();

        return view('site.show', $data);
    }

    public function follow($id)
    {
        $show = Show::findOrFail($id);
        $show->followers()->attach(auth()->id());
        return back();
    }

    public function unfollow($id)
    {
        $show = Show::findOrFail($id);
        $show->followers()->detach(auth()->id());
        return back();
    }

    public function episode($id)
    {
        $data['episode'] = Episode::with('rates')->withCount('likes', 'dislikes')->findOrFail($id);
        $data['rates']   = EpisodeRate::where('episode_id', $id)->get()->pluck('user_id')->toArray();
        return view('site.episode', $data);
    }

    public function like($id)
    {
        $episode = Episode::findOrFail($id);
        EpisodeRate::create([
            'episode_id' => $episode->id,
            'user_id'    => auth()->id(),
            'type'       => 1,
        ]);
        return back();

    }

    public function dislike($id)
    {
        $episode = Episode::findOrFail($id);
        EpisodeRate::create([
            'episode_id' => $episode->id,
            'user_id'    => auth()->id(),
            'type'       => 0,
        ]);
        return back();

    }

    public function search(Request $request)
    {
        $data['shows'] = Show::where('title','LIKE', "%$request->search%")->orWhere('description','LIKE', "%$request->search%")->with('episodes')->get();
        $data['episodes'] = Episode::where('title','LIKE', "%$request->search%")->orWhere('description','LIKE', "%$request->search%")->get();

        return view('site.search', $data);
    }

}
