import axios from "axios";

const request = axios.create({
    baseURL: 'http://localhost:80/datareturn.php',
    timeout: 5000
})

export default request
