#!/bin/bash

# Log file path
LOG_FILE="$(pwd)/.docker/logs/sail_script.log"

# Ensure log directory exists
mkdir -p "$(dirname "$LOG_FILE")"

# Function to log messages
log_message() {
    echo "$(date +'%Y-%m-%d %H:%M:%S') - $1" >> "$LOG_FILE"
}

# Determine the full path to ./vendor/bin/sail
SAIL_PATH="./vendor/bin/sail"

# Alias name (change this as desired)
ALIAS_NAME="s"

# Check if ./vendor/bin/sail exists
if [ -x "$SAIL_PATH" ]; then
    log_message "Found '$SAIL_PATH' in $(pwd)"

    # Check if the alias already exists in the current shell
    if ! command -v "$ALIAS_NAME" &> /dev/null; then
        # Add alias to current shell session
        alias "$ALIAS_NAME"="$SAIL_PATH"
        log_message "Alias '$ALIAS_NAME' for '$SAIL_PATH' added to current shell session."
        echo "Alias '$ALIAS_NAME' for '$SAIL_PATH' added to current shell session."

        # Add alias to shell profile for persistence
        echo "alias $ALIAS_NAME='$SAIL_PATH'" >> "$HOME/.bashrc"  # For Bash
        # echo "alias $ALIAS_NAME='$SAIL_PATH'" >> "$HOME/.zshrc"  # For Zsh

        log_message "Alias '$ALIAS_NAME' added to user's shell profile."
        echo "Alias '$ALIAS_NAME' added to your shell profile (e.g., .bashrc)."
        echo "Applying changes to your current session..."
        source "$HOME/.bashrc"  # Adjust if using Zsh
        echo "Changes applied."
    else
        log_message "Alias '$ALIAS_NAME' already exists in current shell session."
        echo "Alias '$ALIAS_NAME' already exists in current shell session."
    fi
else
    log_message "ERROR: '$SAIL_PATH' not found in $(pwd)"
    echo "ERROR: '$SAIL_PATH' not found in $(pwd)"
    exit 1  # Exit the script with a non-zero status indicating failure
fi
