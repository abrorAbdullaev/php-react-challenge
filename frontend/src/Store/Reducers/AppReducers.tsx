import { AppContextInterface } from "src/Models";
import { AppActions } from "src/Store";
import { AppActionType } from "../Actions";

export const appReducer = (state: AppContextInterface, action: AppActions): AppContextInterface => {
  switch (action.type) {
    case AppActionType.LoadJobs: return { ...state, loadingJobs: true }
    case AppActionType.LoadJobsFail: return { ...state, loadingJobs: false }
    case AppActionType.LoadJobsSuccess: return { ...state, loadingJobs: false, jobs: action.payload.jobs }
    case AppActionType.SetFilters: return { 
      ...state,
      filters: action.payload.filters
    }

    default: return state;
  }
}