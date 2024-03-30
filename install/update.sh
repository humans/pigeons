#!/bin/bash

APP_URL=$(grep "^APP_URL=" .env | cut -d'=' -f2)

if [ -n "$APP_URL" ]; then
    sed -i "s|http://roost.test|$APP_URL|g" public/build/assets/*
    echo "Replacement completed."
else
    echo "Error: APP_URL value not found in .env file."
fi
