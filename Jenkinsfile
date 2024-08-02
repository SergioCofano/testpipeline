pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Run Tests') {
            steps {
                script {
                    // Installa PHPUnit se necessario
                    sh 'composer install'
                    // Esegui i test
                    sh 'vendor/bin/phpunit tests/GetGreetingTest.php'
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
        success {
            echo 'Deployment completed successfully.'
        }
        failure {
            echo 'Deployment failed.'
        }
    }
}