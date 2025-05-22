#!/bin/bash

# Save current directory
ORIGINAL_DIR=$(pwd)

# Go up one directory
cd ..

# Set zip and folder name
ZIP_NAME="tmt-hmg.zip"
FOLDER_NAME="tmt-hmg"

echo "Zipping $FOLDER_NAME into $ZIP_NAME..."

zip -r "$ZIP_NAME" "$FOLDER_NAME" \
  -x "$FOLDER_NAME/*.DS_Store" \
  -x "$FOLDER_NAME/__MACOSX/*" \
  -x "$FOLDER_NAME/*.git*" \
  -x "$FOLDER_NAME/node_modules/*" \
  -x "$FOLDER_NAME/.gitignore" \
  -x "$FOLDER_NAME/zip-project.sh" \
  -x "$FOLDER_NAME/Dockerfile" \
  -x "$FOLDER_NAME/.env*" \
  -x "$FOLDER_NAME/docker-compose.yml" \
  -x "$FOLDER_NAME/wordpress_data/*" \
  -x "$FOLDER_NAME/vite.config.js" \
  -x "$FOLDER_NAME/*.zip"

# Move the zip file back to the original directory
mv "$ZIP_NAME" "$ORIGINAL_DIR"

# Go back to the original directory
cd "$ORIGINAL_DIR"

echo "✅ Zip file moved back to $ORIGINAL_DIR"
echo "✅ Done!"
