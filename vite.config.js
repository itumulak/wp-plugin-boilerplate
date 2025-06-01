
import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import { v4wp } from '@kucrut/vite-for-wp';
import path from "path";

export default defineConfig({
    plugins: [
        react(),
        v4wp({
            input: {
                dashboard: 'src/pages/Dashboard/main.jsx',
            },
            outDir: 'dist'
        }),
    ],
    resolve: {
        alias: {
          "@": path.resolve(__dirname, "./src"),
        },
    }
});