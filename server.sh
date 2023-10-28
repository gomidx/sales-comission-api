#!/bin/bash

RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m'

echo ""
echo -e "${RED} ------ Down all containers ------${NC}"
echo ""
docker-compose down

echo ""
echo -e "${RED} ------ Building project ------${NC}"
echo ""
docker build -t sales-comission-system .

echo ""
echo -e "${GREEN} ------ Starting containers ------${NC}"
echo ""
docker-compose -f docker-compose.yml up -d --build

echo ""
echo -e "${GREEN} ------ Start application ------${NC}"
echo ""
sleep 4