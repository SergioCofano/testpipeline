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
                    sh 'vendor/bin/phpunit --log-junit junit-report.xml'
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
                        remoteDirectory: '/var/www/html/',
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
            junit 'junit-report.xml'
        }
        success {
            echo 'Deployment completed successfully.'
        }
        failure {
            echo 'Deployment failed.'
        }
    }
}