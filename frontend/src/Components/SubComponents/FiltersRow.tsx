import React from 'react';
import { FormControl, TableCell, TableRow, Select, MenuItem, InputLabel } from '@material-ui/core';
import { Filter, filterableFields, Job } from 'src/Models';

export const FiltersRow: React.FC<Props> = ({ jobs, filters, applyFilter }) => {
  const filterCells: (filterableFields | '')[] = [
    '',
    '',
    'location',
    'department',
    'type',
  ];

  const getFilterValue: (filterCellName: filterableFields) => string = (filterCellName) => {
    const foundFilter = filters.find((filter) => Object.keys(filter).includes(filterCellName));

    if (!!foundFilter) {
      return foundFilter[filterCellName];
    }

    return '';
  }

  const getFilterOptions: (filterCellName: filterableFields) => string[] = (filterCellName) => {
    return jobs.map((job) => job[filterCellName]).filter((v, i, s) => s.indexOf(v) === i);
  }

  return (
    <TableRow>
      {filterCells.map((filterCell, ind) => 
        <TableCell key={ind}>
          { !!filterCell && (
            <FormControl>
              <InputLabel>{filterCell}</InputLabel>
              <Select style={{ minWidth: '120px' }} value={getFilterValue(filterCell)} onChange={({ target }) => applyFilter(filterCell, target.value as string)}>
                <MenuItem value=''>Any</MenuItem>
                {
                  getFilterOptions(filterCell).map((filterOption, ind) => (
                    <MenuItem value={filterOption.toLowerCase()} key={ind}>{filterOption}</MenuItem>
                  ))
                }
              </Select>
            </FormControl>
          )}
        </TableCell>
      )}
    </TableRow>
  )
}

interface Props {
  jobs: Job[],
  filters: Filter[],
  applyFilter: (filterName: filterableFields, filterValue: string) => void
}
