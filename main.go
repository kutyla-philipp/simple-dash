package main

import (
	"encoding/json"
	"html/template"
	"io/ioutil"
	"log"
	"net/http"
	"os"
)

type DashItem struct {
	Name string `json:"alt"`
	Icon string `json:"icon"`
	Link string `json:"link"`
}

type User struct {
	Password string `json:"adminpass"`
}

type DashData struct {
	Title string     `json:"title"`
	Items []DashItem `json:"items"`
}

func parseConfig() (*DashData, *User) {
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
	var user User
	errA := json.Unmarshal(configBytes, &data)
	errB := json.Unmarshal(configBytes, &user)
	if errA != nil || errB != nil {
		log.Fatalf("Can not parse config as json || %s\n", configPath)
	}
	log.Printf("Found %d items in the config\n", len(data.Items))
	return &data, &user
}

func main() {
	log.Println("Starting Simple Dash")

	dashTemplate := template.Must(template.ParseFiles("templates/dash.html"))
	sigininTemplate := template.Must(template.ParseFiles("templates/login.html"))

	data, user := parseConfig()

	http.HandleFunc("/", func(w http.ResponseWriter, r *http.Request) {
		dashTemplate.Execute(w, data)
	})
	http.HandleFunc("/admin", func(w http.ResponseWriter, r *http.Request) {
		if r.Method != http.MethodPost {
			sigininTemplate.Execute(w, nil)
			return
		}

		if r.FormValue("password") == user.Password {
			log.Printf("Admin account accessed\n")
			dashTemplate.Execute(w, data)
			return
		}

		sigininTemplate.Execute(w, struct{ Invalid bool }{true})
	})
	http.ListenAndServe(":80", nil)
}
