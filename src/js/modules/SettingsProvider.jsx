import {createContext} from "react";

const {useContext} = wp.element;

const SettingsContext = createContext();
export const SettingsProvider = ({children, settings}) => {
    return (
        <SettingsContext.Provider value={settings}>
            {children}
        </SettingsContext.Provider>
    );
};

export const useSettings = () => useContext(SettingsContext);