import { Job } from 'src/Models';

export type filterableFields = 'location' | 'department' | 'type';
export type Filter = {[key in filterableFields]: string};

export interface AppContextInterface {
  jobs: Job[],
  loadingJobs: boolean,
  filters: Filter[],
}

export const defaultAppContext: AppContextInterface = {
  jobs: [],
  loadingJobs: false,
  filters: [],
}
