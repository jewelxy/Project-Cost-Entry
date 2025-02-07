import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';
import Select from 'react-select';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import ProjectCostTable from './ProjectCostTable';

const ProjectCostEntry = () => {
  const baseApiUrl = process.env.REACT_APP_BASE_API_URL;
  const [customers, setCustomers] = useState([]);
  const [projectsMap, setProjectsMap] = useState({});
  const [rows, setRows] = useState([{ id: Date.now(), selectedCustomer: null, selectedProject: null, cost: '' }]);
  const [loading, setLoading] = useState(false);

  // Fetch customers when the component mounts
  useEffect(() => {
    const fetchCustomers = async () => {
      try {
        const response = await axios.get(`${baseApiUrl}/api/customers`);
        setCustomers(response.data);
      } catch (error) {
        console.error('Error fetching customers:', error);
      }
    };
    fetchCustomers();
  }, [baseApiUrl]);

  // Fetch projects dynamically for a selected customer
  const fetchProjects = useCallback(async (customerId) => {
    if (!projectsMap[customerId]) {
      try {
        const response = await axios.get(`${baseApiUrl}/api/projects/${customerId}`);
        setProjectsMap(prev => ({ ...prev, [customerId]: response.data }));
      } catch (error) {
        console.error('Error fetching projects:', error);
      }
    }
  }, [baseApiUrl, projectsMap]);

  const handleCustomerChange = (selectedOption, rowId) => {
    setRows(rows.map(row =>
      row.id === rowId ? { ...row, selectedCustomer: selectedOption, selectedProject: null } : row
    ));

    if (selectedOption) {
      fetchProjects(selectedOption.value);
    }
  };

  const handleProjectChange = (selectedOption, rowId) => {
    setRows(rows.map(row =>
      row.id === rowId ? { ...row, selectedProject: selectedOption } : row
    ));
  };

  const handleCostChange = (e, rowId) => {
    setRows(rows.map(row =>
      row.id === rowId ? { ...row, cost: e.target.value } : row
    ));
  };

  const addNewRow = () => {
    setRows([...rows, { id: Date.now(), selectedCustomer: null, selectedProject: null, cost: '' }]);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);

    const data = {
      rows: rows.map(row => ({
        customer_id: row.selectedCustomer?.value,
        project_id: row.selectedProject?.value,
        cost: parseFloat(row.cost),
      })),
    };

    try {
      await axios.post(`${baseApiUrl}/api/project-cost`, data);
      toast.success('Project costs added successfully!', { position: 'top-right', autoClose: 3000 });
      setRows([{ id: Date.now(), selectedCustomer: null, selectedProject: null, cost: '' }]);
    } catch (error) {
      if (error.response?.data?.errors) {
        Object.values(error.response.data.errors).forEach(messages =>
          messages.forEach(msg =>
            toast.error(msg, { position: 'top-right', autoClose: 3000 })
          )
        );
      } else {
        toast.error('An error occurred. Please try again.', { position: 'top-right', autoClose: 3000 });
      }
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="w-10/12 mx-auto mt-10 p-5 border rounded-lg shadow-lg bg-white">
      <ToastContainer />
      <h2 className="text-xl font-semibold bg-blue-600 text-white p-3 rounded-t-lg text-center">Project Cost Entry</h2>

      <form onSubmit={handleSubmit} className="p-5 space-y-4">
        {rows.map(row => (
          <div key={row.id} className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div className="flex flex-col">
              <label className="text-gray-700 font-medium mb-1">Customer Name</label>
              <Select
                options={customers.map(c => ({ value: c.id, label: c.name }))}
                value={row.selectedCustomer}
                onChange={(option) => handleCustomerChange(option, row.id)}
                isClearable
                className="shadow-sm"
              />
            </div>
            <div className="flex flex-col">
              <label className="text-gray-700 font-medium mb-1">Project Name</label>
              <Select
                options={row.selectedCustomer ? projectsMap[row.selectedCustomer.value]?.map(p => ({ value: p.id, label: p.name })) || [] : []}
                value={row.selectedProject}
                onChange={(option) => handleProjectChange(option, row.id)}
                isClearable
                className="shadow-sm"
                isDisabled={!row.selectedCustomer}
              />
            </div>
            <div className="flex flex-col">
              <label className="text-gray-700 font-medium mb-1">Project Cost</label>
              <input
                type="number"
                step="0.01"
                value={row.cost}
                onChange={(e) => handleCostChange(e, row.id)}
                required
                className="border rounded px-3 py-2 w-full bg-gray-200 shadow-sm"
              />
            </div>
          </div>
        ))}
        <button type="button" onClick={addNewRow} className="bg-blue-600 text-white px-5 py-2 rounded shadow-md hover:bg-blue-500">Add New</button>
        <div className="flex justify-end">
          <button type="submit" disabled={loading} className="bg-blue-600 text-white px-5 py-2 rounded shadow-md hover:bg-blue-700">
            {loading ? 'Submitting...' : 'Submit'}
          </button>
        </div>
      </form>

      <ProjectCostTable refresh={loading} />
    </div>
  );
};

export default ProjectCostEntry;
