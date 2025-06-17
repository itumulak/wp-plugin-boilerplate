// scripts/build-blocks.js
import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

// Convert import.meta.url to a path for __dirname equivalent
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const blocksDir = path.resolve(__dirname, '../src/blocks');
const distDir = path.resolve(__dirname, '../dist');

console.log('Starting WordPress blocks build process...');

if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir, { recursive: true });
}

// Get all block directories
const blockFolders = fs.readdirSync(blocksDir, { withFileTypes: true })
    .filter(dirent => dirent.isDirectory())
    .map(dirent => dirent.name);

if (blockFolders.length === 0) {
    console.log('No block folders found in src/blocks. Exiting.');
    process.exit(0);
}

blockFolders.forEach(blockName => {
    const blockPath = path.join(blocksDir, blockName);
    const buildOutputPath = path.join(blockPath, 'build');
    const finalDistPath = path.join(distDir, blockName);

    console.log(`\n--- Building block: ${blockName} ---`);

    try {
        // Change directory to the block folder and run wp-scripts --build
        execSync('npx wp-scripts build', { stdio: 'inherit', cwd: blockPath });
        console.log(`Successfully built ${blockName}.`);

        // Move the 'build' folder to 'dist/{blockName}'
        if (fs.existsSync(buildOutputPath)) {
            console.log(`Moving ${buildOutputPath} to ${finalDistPath}...`);
            // Ensure the parent directory for the final path exists
            fs.mkdirSync(path.dirname(finalDistPath), { recursive: true });
            fs.renameSync(buildOutputPath, finalDistPath);
            console.log(`Moved ${blockName} build to ${finalDistPath}`);
        } else {
            console.warn(`Warning: 'build' folder not found for ${blockName} at ${buildOutputPath}. Skipping move.`);
        }

    } catch (error) {
        console.error(`Error building or moving block ${blockName}:`, error.message);
        process.exit(1); // Exit with an error code
    }
});

console.log('\nAll blocks processed successfully!');