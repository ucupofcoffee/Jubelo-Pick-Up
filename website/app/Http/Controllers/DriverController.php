<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('status', 'active')->get();

        return view('driver.index', [
            'drivers' => $drivers,
            'title' => 'Manage Driver'
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $drivers = Driver::where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('phone', 'LIKE', '%'.$search.'%')
            ->orWhere('email', 'LIKE', '%'.$search.'%')
            ->get();

        return view('driver.index', [
            'drivers' => $drivers,
            'title' => 'Manage Driver'
        ]);
    }

    public function create()
    {
        return view('driver.create', [
            'title' => 'Manage Driver'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:drivers,name',
            'phone' => 'required|unique:drivers,phone',
            'email' => 'required|email:rfc,dns|unique:drivers,email',
            'password' => 'required|min:8|max:255',
            'status' => 'required',
            'day' => 'required',
        ]);

        $driver = Driver::create([
            'name' => ucwords(strtolower($validatedData['name'])),
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status' => $validatedData['status'],
            'day' => $validatedData['day'],
        ]);

        if ($driver->save()) {
            return redirect()->route('driver.index')->with('success', 'Driver created successfully');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create Driver. Please try again']);
        }
    }

    public function edit($driverid)
    {
        $driver = Driver::find($driverid);

        if ($driver) {
            return view('driver.edit', [
                'driver' => $driver,
                'title' => 'Manage Driver'    
            ]);
        } else {
            return redirect()->route('driver.index')->with('error', 'Driver not found');
        }
    }

    public function update(Request $request, $driverid)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:drivers,name,'.$driverid.',driverid',
            'phone' => 'required|unique:drivers,phone,'.$driverid.',driverid',
            'email' => 'required|email:rfc,dns|unique:drivers,email,'.$driverid.',driverid',
            'password' => 'nullable|min:8|max:255',
            'day' => 'required'
        ]);

        $driver = Driver::find($driverid);
        $driver->name = ucwords(strtolower($validatedData['name']));
        $driver->phone = $validatedData['phone'];
        $driver->email = $validatedData['email'];
        $driver->password = Hash::make($validatedData['password']);
        $driver->day = $validatedData['day'];

        if ($driver->save()) {
            return redirect()->route('driver.index')->with('success', 'Driver updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update Driver. Please try again');
        }
    }

    public function delete($driverid)
    {
        $driver = Driver::find($driverid);
    
        if ($driver) {
            $driver->status = 'Deadactive';
            if ($driver->save()) {
                return redirect()->back()->with('success', 'Driver deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to delete Driver. Please try again');
            }
        } else {
            return redirect()->back()->with('error', 'Driver not found');
        }
    }
    
}
