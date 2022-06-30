import axios from "axios";

export default {
    data() {
        return {};
    },
    methods: {
        async callApi(method, url) {
            try {
                return await axios({
                    method: method,
                    url: this.$env_Url + url,
                });
            } catch (e) {
                console.log(e);
                return e.response;
            }
        },
        async callApiwParam(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url:this.$env_Url + url,
                    data: dataObj,
                });
            } catch (e) {
                return e.response;
            }
        },
        async getDataFromDB(method, url) {
            try {
                return await axios({
                    method: method,
                    url:this.$env_Url + url,
                });
            } catch (e) {
                return e.response;
            }
        },
        getLoggedIn(method, url) {
            try {
                return axios({
                    method: method,
                    url:this.$env_Url + url,
                });
            } catch (e) {
                return e.response;
            }
        },
        async submit(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url:this.$env_Url + url,
                    data: dataObj,
                });
            } catch (e) {
                return e.response;
            }
        },
        async deleteRecord(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url:this.$env_Url + url,
                    data: dataObj,
                });
            } catch (e) {
                return e.response;
            }
        },
        //alert message
        async smessage() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "Record saved",
                life: 3000,
            });
        },
        async updmessage() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "Record updated",
                life: 3000,
            });
        },
        async rmessage() {
            this.$toast.add({
                severity: "warn",
                summary: "Confirmed",
                detail: "Record deleted",
                life: 3000,
            });
        },
        async ermessage(arrMessage) {
            this.$toast.removeAllGroups();
            for (const property in arrMessage) {
                this.$toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: `${arrMessage[property]}`,
                    life: 5000,
                });
            }
        },
        async singleermessage(arrMessage) {
                this.$toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: `${arrMessage}`,
                    life: 5000,
                });
        },
        async pmessage() {
            this.$toast.add({
                severity: "info",
                summary: "Confirmed",
                detail: "Reset Password",
                life: 3000,
            });
        },     

        async imessage() {
            this.$toast.add({
                severity: "warn",
                summary: "Confirmed",
                detail: "User Deactivated",
                life: 3000,
            });
        }, 

        async amessage() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "User Activated",
                life: 3000,
            });
        },     
        async emailmessage($detail) {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: $detail,
                life: 3000,
            });
        },
        async logoutmessage() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "User logged out",
                life: 3000,
            });
        },

        async reindexmessage() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "Application Reindex",
                life: 3000,
            });
        },  

        async shrinkmessage() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "Application Database Shrink",
                life: 3000,
            });
        },          

        async syncmessage() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "Application Sync",
                life: 3000,
            });
        },       
        
        async clearLogs() {
            this.$toast.add({
                severity: "success",
                summary: "Confirmed",
                detail: "Clear Logs",
                life: 3000,
            });
        },           
        
    },
};
