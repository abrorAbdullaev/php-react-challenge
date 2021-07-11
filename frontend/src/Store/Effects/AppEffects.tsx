import { AppActions, AppActionType } from "../Actions";
import { getJobs } from "src/Services";
import React from "react";
import { Filter, filterableFields } from "src/Models";

export const loadJobs: (dispatch: React.Dispatch<AppActions>) => AppActions = (dispatch) => {
  getJobs().then((resp) => {
    dispatch({
      type: AppActionType.LoadJobsSuccess,
      payload: resp,
    })
  }).catch((err) => {
    dispatch({ type: AppActionType.LoadJobsFail })
    console.log(err);
  }); // For now console.log. But better to do propper error handling

  return { type: AppActionType.LoadJobs };
}

/**
 * I don't see the use case of this, as the whole list can be already filtered by hiding/showing the items instead of sending another request to the server
 */
export const applyFilters: (dispatch: React.Dispatch<AppActions>, field: filterableFields, value: string, filters: Filter[]) => AppActions 
  = (dispatch, field, value, filters) => {
  dispatch({
    type: AppActionType.LoadJobs,
  });

  const newFilters = filters;
  const filterInd = filters.findIndex((filter) => filter[field] !== undefined);
  if (filterInd >= 0) {
    newFilters[filterInd] = {[field]: value} as Filter;
  } else {
    newFilters.push({[field]: value} as Filter);
  }

  getJobs(newFilters).then((resp) => {
    dispatch({
      type: AppActionType.LoadJobsSuccess,
      payload: resp
    });
  }).catch((err) => {
    dispatch({ type: AppActionType.LoadJobsFail })
    console.log(err); // For now console.log. But better to do propper error handling
  });

  return {
    type: AppActionType.SetFilters,
    payload: { filters: newFilters },
  }
}
