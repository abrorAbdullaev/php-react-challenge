import React from 'react';

import { AppContextInterface, defaultAppContext } from 'src/Models';
import { AppActions } from 'src/Store';

const AppContext = React.createContext<
  { 
    state: AppContextInterface, 
    dispatch: React.Dispatch<AppActions> 
  }
>({
  state: defaultAppContext,
  dispatch: () => undefined,
});

export { AppContext };
