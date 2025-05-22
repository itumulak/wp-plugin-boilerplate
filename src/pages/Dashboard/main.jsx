import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import Dashboard from "./Dashboard";

createRoot(document.getElementById("hmg-dashboard")).render(
    <StrictMode>
      <Dashboard/>
    </StrictMode>,
);
  