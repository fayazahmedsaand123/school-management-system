<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TenantController extends Controller {

    // ============== List all schools ============== //
    public function index() {
        $tenants = Tenant::latest()->get();

        return Inertia::render('Tenants/Index', [
            'tenants' => $tenants
        ]);
    }

    // ========== Show create form =============== //
    public function create() {
        return Inertia::render('Tenants/Create');
    }

    // ============ Save new school =============== //
    public function store(Request $request) {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:tenants,email',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        Tenant::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('tenants.index')->with('success', 'School created successfully!');
    }

    // =========== Show edit form =============== //
    public function edit(Tenant $tenant) {
        return Inertia::render('Tenants/Edit', [
            'tenant' => $tenant
        ]);
    }

    // ============= Update school ================ //
    public function update(Request $request, Tenant $tenant) {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:tenants,email,' . $tenant->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $tenant->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('tenants.index')->with('success', 'School updated successfully!');
    }

    // ========= Delete school =============== //
    public function destroy(Tenant $tenant) {
        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'School deleted successfully!');
    }
}