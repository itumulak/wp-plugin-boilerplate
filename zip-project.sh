#!/bin/bash

# Prompt for folder name to zip
read -rp "Enter the folder name to zip: " FOLDER_NAME

# Check if folder exists
if [ ! -d "../$FOLDER_NAME" ]; then
  echo "❌ Folder '../$FOLDER_NAME' does not exist."
  exit 1
fi

# Prompt for zip file name
read -rp "Enter the name of the zip file to create (e.g. output.zip): " ZIP_NAME

# Ensure .zip extension is present
if [[ "$ZIP_NAME" != *.zip ]]; then
  ZIP_NAME="${ZIP_NAME}.zip"
fi

# Prompt for internal folder name (inside the zip)
read -rp "Enter the folder name to create inside the zip (leave blank to use '$FOLDER_NAME'): " ZIP_FOLDER_NAME

# Default to FOLDER_NAME if input is empty
if [ -z "$ZIP_FOLDER_NAME" ]; then
  ZIP_FOLDER_NAME="$FOLDER_NAME"
fi

# Save original directory
ORIGINAL_DIR=$(pwd)

# Go up one directory to access source folder
cd .. || exit

# Create a temporary workspace in /tmp
TEMP_WORKSPACE="/tmp/__zip_temp_workspace_$$"
mkdir -p "$TEMP_WORKSPACE"

# Copy project folder into temp workspace under the zip name
cp -r "$FOLDER_NAME" "$TEMP_WORKSPACE/$ZIP_FOLDER_NAME"

# Navigate into temp workspace
cd "$TEMP_WORKSPACE" || exit

echo "📦 Zipping '$ZIP_FOLDER_NAME' into '$ZIP_NAME'..."

zip -r "$ZIP_NAME" "$ZIP_FOLDER_NAME" \
  -x "$ZIP_FOLDER_NAME/*.DS_Store" \
  -x "$ZIP_FOLDER_NAME/__MACOSX/*" \
  -x "$ZIP_FOLDER_NAME/*.git*" \
  -x "$ZIP_FOLDER_NAME/node_modules/*" \
  -x "$ZIP_FOLDER_NAME/.gitignore" \
  -x "$ZIP_FOLDER_NAME/zip-project.sh" \
  -x "$ZIP_FOLDER_NAME/Dockerfile" \
  -x "$ZIP_FOLDER_NAME/.env*" \
  -x "$ZIP_FOLDER_NAME/docker-compose.yml" \
  -x "$ZIP_FOLDER_NAME/wordpress_data/*" \
  -x "$ZIP_FOLDER_NAME/vite.config.js" \
  -x "$ZIP_FOLDER_NAME/*.zip" \
  -x "$ZIP_FOLDER_NAME/README.md" \
  -x "$ZIP_FOLDER_NAME/.vscode/*"

# Remove the temp renamed folder
rm -rf "$ZIP_FOLDER_NAME"

# Move the zip back to original location
mv "$ZIP_NAME" "$ORIGINAL_DIR"

# Return to original location
cd "$ORIGINAL_DIR" || exit

echo "✅ Zip file '$ZIP_NAME' moved back to $ORIGINAL_DIR"
echo "✅ Done!"
