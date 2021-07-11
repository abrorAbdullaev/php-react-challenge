import React, { useContext, useEffect, useState } from 'react';
import { Grid, Typography, Table, TableContainer, TableHead, TableRow, TableCell, Paper, TableBody, Box, LinearProgress } from '@material-ui/core';

import { AppContext, applyFilters, loadJobs } from 'src/Store';
import { FiltersRow } from './SubComponents/FiltersRow';
import { filterableFields } from 'src/Models';

export const JobsList: React.FC = () => {
  const { state, dispatch } = useContext(AppContext);
  const [mounted, setMounted] = useState(false);


  useEffect(() => {
    if (!mounted) {
      dispatch(loadJobs(dispatch));
      setMounted(true);
    }
  }, [setMounted, dispatch, mounted]);

  const tableHeaders = !!state.jobs.length ? Object.keys(state.jobs[0]) : [];

  const applyFilter: (filterName: filterableFields, filterValue: string) => void = (filterName, filterValue) => {
    dispatch(applyFilters(dispatch, filterName, filterValue, state.filters));
  }

  return (
    <Grid container>
      <Grid item xs={12}>
        <Typography variant="h3" gutterBottom component="h1" style={{ textAlign: 'center' }}>
          Actual Jobs List
        </Typography>
      </Grid>
      { !!state.loadingJobs && <Grid item xs={12} style={{ margin: '0 auto' }}> <LinearProgress /> </Grid> }
      <Grid item xs={12} md={8} style={{ margin: '0 auto' }}>
        { !!state.jobs.length && !state.loadingJobs &&
          (
            <TableContainer component={Paper}>
              <Table aria-label="simple table">
                <TableHead>
                  <TableRow style={{ backgroundColor: '#7C83FD' }}>
                    {
                      tableHeaders.map((header, ind) => 
                        <TableCell key={ind}>
                          <Box fontWeight={600}>{header}</Box>
                        </TableCell>
                      )
                    }
                  </TableRow>
                </TableHead>
                <TableBody>
                  <FiltersRow jobs={state.jobs} filters={state.filters} applyFilter={applyFilter} />
                  {
                    state.jobs.map((job, ind) => (
                      <TableRow key={ind}>
                        {
                          Object.values(job).map((val, ind) => <TableCell key={ind}>{val}</TableCell>)
                        }
                      </TableRow>
                    ))
                  }
                </TableBody>
              </Table>
            </TableContainer>
          )
        }
      </Grid>
    </Grid>
  );
}
