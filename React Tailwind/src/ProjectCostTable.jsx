import React, { useEffect, useState } from 'react';
import axios from 'axios';

const ProjectCostTable = ({ refresh }) => {
  const baseApiUrl = process.env.REACT_APP_BASE_API_URL;
  const [projectCosts, setProjectCosts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    setLoading(true);
    axios.get(`${baseApiUrl}/api/project-cost`)
      .then(response => {
        setProjectCosts(response.data);
        setLoading(false);
      })
      .catch(error => {
        console.error('Error fetching project costs:', error);
        setLoading(false);
      });
  }, [refresh]);

  return (
    <div className="w-11/12 mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg">
      <h2 className="text-xl font-semibold bg-blue-600 text-white p-3 rounded-t-lg text-center">Project Cost List</h2>

      <div className="overflow-x-auto">
        <table className="w-full bg-white border border-gray-300 rounded-lg">
          <thead>
            <tr className="bg-blue-600 text-white">
              <th className="px-4 py-2">Customer Name</th>
              <th className="px-4 py-2">Tracking ID</th>
              <th className="px-4 py-2">Project Name</th>
              <th className="px-4 py-2">Project Cost (৳)</th>
            </tr>
          </thead>
          <tbody>
            {loading ? <tr><td colSpan="4" className="text-center py-4">Loading...</td></tr> : 
              projectCosts.map(cost => (
                <tr key={cost.id} className="border-b hover:bg-gray-100">
                  <td className="px-4 py-2">{cost.customer?.name || 'N/A'}</td>
                  <td className="px-4 py-2">{cost.tracking_id}</td>
                  <td className="px-4 py-2">{cost.project?.name || 'N/A'}</td>
                  <td className="px-4 py-2 font-semibold">৳ {parseFloat(cost.cost).toFixed(2)}</td>
                </tr>
              ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ProjectCostTable;
