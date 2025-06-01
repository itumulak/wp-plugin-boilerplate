import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import SampleNotes from "./SampleNotes";

createRoot(document.getElementById("sample-notes")).render(
    <StrictMode>
      <SampleNotes/>
    </StrictMode>,
);
  