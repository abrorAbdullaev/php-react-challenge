import { filterableFields, Job } from "src/Models";

export const getJobs: (filters?: {[key in filterableFields]: string}[]) => Promise<{jobs: Job[]}> = (filters) => {
  let url = 'http://simpleapi.test/?c=jobs';

  !!filters && filters.forEach((filter) => {
    Object.keys(filter).forEach((keyName) => {
      if (!filter[keyName as filterableFields]) { return; }
      url += `&${keyName}=${filter[keyName as filterableFields]}`;
    });
  });

  return fetch(url, { method: 'GET' })
  .then((resp) => resp.json())
  .then((result: { jobs: Job[] }) => result);
}