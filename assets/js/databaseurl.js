function connect(){

        const firebaseConfig = {
          apiKey: "AIzaSyDmezgJ-zRbF17C5gcxaFadUdk6OGA2f1I",
            authDomain: "healthydiet-cb745.firebaseapp.com",
            projectId: "healthydiet-cb745",
            storageBucket: "healthydiet-cb745.appspot.com",
            messagingSenderId: "549986503315",
            appId: "1:549986503315:web:66a560c21f7a12f91e5b66"
        };
        
        return firebaseConfig;
    }

function logout(){
    localStorage.removeItem("calorieusername");
    window.location.href="page-login_f.html";
}