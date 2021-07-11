import { Filter, Job } from 'src/Models';

export enum AppActionType {
  LoadJobs,
  LoadJobsSuccess,
  LoadJobsFail,
  SetFilters,
}

export interface LoadJobs {
  type: AppActionType.LoadJobs,
}

export interface LoadJobsSuccess {
  type: AppActionType.LoadJobsSuccess,
  payload: { jobs: Job[] },
}

export interface LoadJobsFail {
  type: AppActionType.LoadJobsFail,
}

export interface SetFilters {
  type: AppActionType.SetFilters,
  payload: { filters: Filter[] },
}

export type AppActions = LoadJobs | LoadJobsSuccess | LoadJobsFail | SetFilters;
