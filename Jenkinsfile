pipeline{
    agent any
    environment{
        staging_server="127.0.0.1:5500"
    }
    stages{
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/SergioCofano/testpipeline.git'
            }
        }
        stage('Deploy to Remote'){
            steps{
                sh 'scp ${WORKSPACE}/* root@${staging_server}:/Utenti/Utente/wa/testpipeline'
            }
        }
    }
}