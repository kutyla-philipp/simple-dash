package main

import (
	"encoding/json"
	"io/ioutil"
	"log"
	"os"
)

type DashItem struct {
	Name string `json:"alt"`
	Icon string `json:"icon"`
	Link string `json:"link"`
}

type DashData struct {
	Title string     `json:"title"`
	Items []DashItem `json:"items"`
}

func parseConfig() *DashData {
	log.Println("Finding Config")
	configPath := os.Getenv("CONFIG_DIR") + "/config.json"
	if _, err := os.Stat(configPath); err != nil {
		log.Fatalf("Can not find config at: %s\n", configPath)
	}
	configBytes, err := ioutil.ReadFile(configPath)
	if err != nil {
		log.Fatalf("Can not open config at: %s\n", configPath)
	}
	var data DashData
	err = json.Unmarshal(configBytes, &data)
	if err != nil {
		log.Fatalf("Can not parse config as json || %s\n", configPath)
	}
	log.Printf("Found %d items in the config\n", len(data.Items))
	return &data
}

func main() {
	log.Println("Starting Simple Dash")

	data := parseConfig()

	log.Printf("Data Title: %s\n", data.Title)
}
