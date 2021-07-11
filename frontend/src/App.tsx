import React, { useReducer } from 'react';

import { AppContext, appReducer } from 'src/Store';
import { defaultAppContext } from 'src/Models';
import { JobsList } from './Components';

function App() {
  const [state, dispatch] = useReducer(appReducer, defaultAppContext);

  return (
    <AppContext.Provider value={{ state, dispatch }}>
      <div className="App">
        <JobsList />
      </div>
    </AppContext.Provider>
  );  
}

export default App;
