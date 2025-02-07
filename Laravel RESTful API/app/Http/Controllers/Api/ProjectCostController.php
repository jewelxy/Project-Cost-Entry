<?php

namespace App\Http\Controllers\Api;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ProjectCost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectCostController extends Controller
{
    /**
     * Retrieve all customers.
     *
     * This method retrieves all customers from the database and returns
     * a collection of customer objects.
     *
     */
    public function getCustomers()
    {
        return Customer::all();
    }

    /**
     * Retrieve projects associated with a specific customer.
     *
     * This method queries the database for projects that are linked to the
     * provided customer ID and returns a collection of matching projects.
     *
     */

    public function getProjects($customer_id)
    {
        return Project::where('customer_id', $customer_id)->get();
    }

    /**
     * Store new project costs in the database.
     *
     * This method validates the incoming request to ensure that the data contains an array of rows,
     * each with a valid customer_id, project_id, and cost. For each valid row, it retrieves the 
     * corresponding project, generates a unique tracking ID, and creates a new ProjectCost entry 
     * in the database with the associated project ID, cost, and tracking ID. The ID of the user 
     * creating the entry is also stored, defaulting to 1 cause authentication information is unavailable.
     *
     */

    public function store(Request $request)
    {
        $data = $request->validate([
            'rows' => 'required|array',
            'rows.*.customer_id' => 'required|exists:tbl_customer,id',
            'rows.*.project_id' => 'required|exists:tbl_project,id',
            'rows.*.cost' => 'required|numeric|min:0',
        ]);
    
        foreach ($data['rows'] as $row) {
            $project = Project::find($row['project_id']);
    
            $timestamp = now()->format('YmdHisv'); // YearMonthDateHourMinuteSecondMilliseconds
            $tracking_id = strtoupper(implode('', array_map(function ($word) {
                return $word[0];
            }, explode(' ', $project->name)))) . '-' . $timestamp;
    
            ProjectCost::create([
                'customer_id' => $row['customer_id'],
                'project_id' => $row['project_id'],
                'cost' => $row['cost'],
                'tracking_id' => $tracking_id,
                'created_by' => auth()->id() ?? 1,
            ]);
        }
    
        return response()->json(['message' => 'Project costs added successfully.']);
    }


    /**
     * Return a JSON response of all project costs, including their associated projects and customers.
     *
     * This method queries the database for all project costs and their associated projects and customers,
     * and returns the results as a JSON response.
     *
     */
      public function index()
      {
          $projectCosts = ProjectCost::with(['project', 'customer'])->get();
  
          return response()->json($projectCosts, 200);
      }
    
    
}
