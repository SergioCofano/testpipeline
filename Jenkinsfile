pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Install Dependencies') {
            steps {
                script {
                    echo 'Installing dependencies...'
                    sh 'composer install'
                }
            }
        }
        stage('Run Tests') {
            steps {
                script {
                    echo 'Running tests...'
                    sh 'vendor/bin/phpunit --log-junit tests/junit-report.xml'  // Aggiorna il percorso del report
                }
            }
        }
        stage('Debug Report') {
            steps {
                script {
                    echo 'Debugging report...'
                    sh 'ls -al tests'  // Mostra i file nella cartella tests per confermare la presenza del report
                    sh 'cat tests/junit-report.xml'  // Mostra il contenuto del report XML per la verifica
                }
            }
        }
        stage('Deploy PHP application') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(
                    configName: 'php_server',
                    transfers: [sshTransfer(
                        cleanRemote: false,
                        excludes: '',
                        execCommand: '',
                        execTimeout: 120000,
                        flatten: false,
                        makeEmptyDirs: false,
                        noDefaultExcludes: false,
                        patternSeparator: '[, ]+',
                        remoteDirectory: '/www/wwwroot/testrepo',
                        remoteDirectorySDF: false,
                        removePrefix: '',
                        sourceFiles: '**/*.php'
                    )],
                    usePromotionTimestamp: false,
                    useWorkspaceInPromotion: false,
                    verbose: false
                )])
            }
        }
    }
    post {
        always {
            echo 'Publishing test results...'
            junit 'tests/junit-report.xml'  // Aggiorna il percorso del report
        }
        success {
            echo 'Deployment completed successfully.'
        }
        failure {
            echo 'Deployment failed.'
        }
    }
}
