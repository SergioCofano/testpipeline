// pipeline {
//     agent any
//     environment {
//         staging_server = "10.1.3.189"
//         ssh_port = "22"
//     }
//     stages {
//         stage('Verify sshpass Installation') {
//             steps {
//                 sh 'sshpass -h || { echo "sshpass non è installato. Installalo prima di continuare."; exit 1; }'
//             }
//         }
//         stage('Clone Repository') {
//             steps {
//                 git branch: 'main', url: 'https://github.com/SergioCofano/testpipeline.git'
//             }
//         }
//         stage('Deploy to Remote') {
//             steps {
//                 script {
//                     withCredentials([usernamePassword(credentialsId: 'ServerTest', usernameVariable: 'SSH_USER', passwordVariable: 'SSH_PASS')]) {
//                         echo "Deploying to ${staging_server}:${ssh_port}"
//                         sh '''
//                             set -x

//                             # Setup SSH keyscan for host verification
//                             mkdir -p ~/.ssh
//                             ssh-keyscan -p ${ssh_port} ${staging_server} 2>&1 | tee ssh-keyscan.log >> ~/.ssh/known_hosts
//                             echo "Contents of ~/.ssh/known_hosts:"
//                             cat ~/.ssh/known_hosts
//                             echo "Contents of ssh-keyscan.log:"
//                             cat ssh-keyscan.log

//                             # Deploy files using sshpass for password authentication
//                             sshpass -p "${SSH_PASS}" scp -o StrictHostKeyChecking=no -P ${ssh_port} -r ${WORKSPACE}/* ${SSH_USER}@${staging_server}:/Utenti/Utente/wa/testpipeline
//                         '''
//                     }
//                 }
//             }
//         }
//     }
// }


pipeline {
    agent any

    stages {
        stage('Deploy PHP application') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(configName: 'php_server', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: '', execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '/var/www/html/', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '**/*.php')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
            }
        }
    }
}