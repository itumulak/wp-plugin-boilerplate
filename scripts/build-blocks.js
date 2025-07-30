// scripts/build-blocks.js
import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

// __dirname equivalent for ES modules
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const blocksDir = path.resolve(__dirname, '../src/blocks');
const distDir = path.resolve(__dirname, '../dist');

console.log('Starting WordPress blocks build process...');

// Utility: Recursively copy contents of a folder (not the folder itself)
function copyFolderContents(src, dest) {
    if (!fs.existsSync(dest)) {
        fs.mkdirSync(dest, { recursive: true });
    }

    fs.readdirSync(src).forEach(item => {
        const srcPath = path.join(src, item);
        const destPath = path.join(dest, item);

        if (fs.statSync(srcPath).isDirectory()) {
            copyFolderContents(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    });
}

// Clean dist directory (optional but useful)
if (fs.existsSync(distDir)) {
    fs.rmSync(distDir, { recursive: true, force: true });
}
fs.mkdirSync(distDir, { recursive: true });

// Get all block folders
const blockFolders = fs.readdirSync(blocksDir, { withFileTypes: true })
    .filter(dirent => dirent.isDirectory())
    .map(dirent => dirent.name);

if (blockFolders.length === 0) {
    console.log('No block folders found in src/blocks. Exiting.');
    process.exit(0);
}

blockFolders.forEach(blockName => {
    const blockPath = path.join(blocksDir, blockName);
    const buildOutputBase = path.join(blockPath, 'build');
    const nestedBuildFolder = path.join(buildOutputBase, blockName);
    const finalDistPath = path.join(distDir, blockName);

    console.log(`\n--- Building block: ${blockName} ---`);

    try {
        // Run build
        execSync('npm run build', { stdio: 'inherit', cwd: blockPath });
        console.log(`Successfully built ${blockName}.`);

        if (fs.existsSync(nestedBuildFolder)) {
            console.log(`Copying contents of ${nestedBuildFolder} to ${finalDistPath}...`);
            copyFolderContents(nestedBuildFolder, finalDistPath);
            console.log(`Copied build of ${blockName} to ${finalDistPath}`);
        } else {
            console.warn(`Warning: Expected build folder not found: ${nestedBuildFolder}`);
        }

    } catch (err) {
        console.error(`Error processing ${blockName}:`, err.message);
        process.exit(1);
    }
});

console.log('\nAll blocks processed successfully!');
