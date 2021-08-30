# Bash Script - Example 3

---

Prepare

- on macOS

```bash
brew install terminal-notifier
```

File : auto-deploy-canary.sh

```bash
#!/bin/bash

notify () {
    local title=$1
    local msg=$2
    local url=$3

    echo -e "notify () {"
    echo -e "    title: $title"
    echo -e "    msg: $msg"
    echo -e "    url: $url"
    echo -e "} \n"

    if [ "$url" == "" ]; then
        terminal-notifier \
            -title "$title" \
            -message "$msg" -ignoreDnD -group 1 \
            > /dev/null
    else
        terminal-notifier \
            -title "$title" \
            -message "$msg" -ignoreDnD -group 1 \
            -open "$url" \
            > /dev/null
    fi
}

waitForSecs () {
    local secs=$1
    echo -e "wait for $secs secs \n"
    sleep $secs
}

checkRespStatusCode () {
    local resp=$1
    local respStatusCode=`echo "$resp" | jq '.status'`
    # echo -e "respStatusCode: `echo ${respStatusCode:?200}` \n"

    if [ "$respStatusCode" == "404" ]; then
        notify "Pineline ${pipelineId}" "Not found 404"
        exit
    fi

    if [ "$respStatusCode" == "401" ]; then
        notify "Pineline ${pipelineId}" "Unauthorized 401"
        exit
    fi

    if [ "$respStatusCode" == "400" ]; then
        notify "Pineline ${pipelineId}" "400 Bad Request"
        exit
    fi
}

# 获取最新的流水线信息
getLatestPipeline () {
    local branchName=$1
    local authorName=$2
    local cookie=$3

    local pipeline=`curl --silent \
        --location "https://infra-api.icehe.xyz/infra-phoenix-console/api/pipeline/icehe-xyz-project?branchName=${branchName}&page=0&authorName=${authorName}" \
        --request GET \
        --header "${cookie}" \
        | jq '.list[0]'`
    echo "$pipeline"
}

# 获取流水线详情
getPipelineDetail () {
    local pipelineId=$1
    local projectIdentity=$2
    local cookie=$3

    local pipelineDetail=`curl --silent \
        --location "https://infra-api.icehe.xyz/infra-phoenix-console/api/pipeline/detail/v2/${pipelineId}/${projectIdentity}" \
        --request GET \
        --header "${cookie}"`
    echo "$pipelineDetail"
}

# 触发构建
triggerBuild () {
    local projectIdentity=$1
    local branchName=$2
    local cookie=$3

    echo -e "triggerBuild () { … }"
    curl \
        --location "https://infra-api.icehe.xyz/infra-phoenix-console/api/action/triggerBuild?projectIdentity=${projectIdentity}&branch=${branchName}" \
        --request POST \
        --header "${cookie}"
    echo
}

# 触发部署
triggerDeploy () {
    local projectIdentity=$1
    local pipelineId=$2
    local stage=$3
    local cookie=$4

    echo -e "triggerDeploy () { … }"
    curl \
        --location "https://infra-api.icehe.xyz/infra-phoenix-console/api/action/triggerDeployment?projectIdentity=${projectIdentity}&pipelineId=${pipelineId}&stage=${stage}" \
        --request POST \
        --header "${cookie}"
    echo
}

# 通知审核上线
auditNotify () {
    local projectIdentity=$1
    local pipelineId=$2
    local cookie=$3

    echo -e "auditNotify () { … }"
    curl \
        --location "https://infra-api.icehe.xyz/infra-phoenix-console/api/pipeline/${projectIdentity}/${pipelineId}/audit/notify" \
        --request POST \
        --header "${cookie}"
    echo
}

# 获取审核情况
getPipelineAudit () {
    local projectIdentity=$1
    local pipelineId=$2
    local cookie=$3

    local pipelineAudit=`curl --silent \
        --location "https://infra-api.icehe.xyz/infra-phoenix-console/api/pipeline/${projectIdentity}/${pipelineId}/audit" \
        --request GET \
        --header "${cookie}"`
    echo "$pipelineAudit"
}

echo -e "\n===========START==========="
date +"%Y-%m-%d %H:%M:%S %a"
echo

# 切换 Working Directory
cd ~/Desktop

# 补全 $PATH , 以便使用本地用户安装的命令
PATH=$PATH:/usr/local/bin

authorName=${1}
branchName=master
cookie=`cat cookie.txt`
projectIdentity=icehe-xyz-project
stage=CANARY
tryTimes=96
toTriggerBuild=${2:-0}
toTriggerNotify=${3:-0}
toTriggerDeploy=${4:-0}
toCheckDeploy=${5:-1}

echo -e "PWD: `pwd`"
echo -e "PATH: $PATH"
echo -e "authorName: $authorName"
echo -e "branchName: $branchName"
echo -e "cookie: $cookie"
echo -e "projectIdentity: $projectIdentity"
echo -e "stage: $stage"
echo -e "tryTimes: $tryTimes"
echo -e "toTriggerBuild: $toTriggerBuild"
echo -e "toTriggerNotify: $toTriggerNotify"
echo -e "toTriggerDeploy: $toTriggerDeploy"
echo -e "toCheckDeploy: $toCheckDeploy"
echo

if [ "$authorName" == "" ]; then
    notify "Pineline" "Do nothing for invalid authorName"
    exit
fi

if [ "$toTriggerBuild" == "0" ] && [ "$toTriggerNotify" == "0" ] && [ "$toTriggerDeploy" == "0" ]; then
    notify "Pineline" "Do nothing for invalid params"
    exit
fi

if [ "$toTriggerBuild" == "1" ]; then
    triggerDeploy "$projectIdentity" "$pipelineId" "$stage" "$cookie"
    notify "Pineline ${pipelineId}" "Deploying $stage for branch ${branchName}" \
        "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
    waitForSecs 30
fi

latestPipeline=`getLatestPipeline "$branchName" "$authorName" "$cookie"`
echo -e "latestPipeline: `echo $latestPipeline | jq` \n"
checkRespStatusCode "$latestPipeline"

pipelineId=`echo $latestPipeline | jq '.id'`
echo -e "pipelineId: $pipelineId \n"

triggeredMillis=`echo $latestPipeline | jq '.triggeredTime'`
triggeredSecs=${triggeredMillis:0:10}
nowSecs=`date +%s`

echo -e "triggeredMillis: `echo $triggeredMillis`"
echo -e "triggeredSecs: `echo $triggeredSecs`"
echo -e "nowSecs: `echo $nowSecs`"
echo

if [ $triggeredSecs -lt `expr $nowSecs - 6000` ]; then
    notify "Pineline ${pipelineId}" "Recent pineline not found for branch ${branchName}" \
        "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/?branch=${branchName}&page=0"
    exit
fi

buildSuccess=0
times=$tryTimes
for i in `seq 1 ${times}`; do
    pipelineDetail=`getPipelineDetail "$pipelineId" "$projectIdentity" "$cookie"`
    echo -e "pipelineDetail: `echo $pipelineDetail | jq` \n"
    checkRespStatusCode "$pipelineDetail"

    buildStageStatus=`echo ${pipelineDetail} | jq '.stages[] | select(.stage == "BUILD") | .status'`
    echo -e "buildStageStatus: `echo $buildStageStatus | jq` \n"

    if [ "$buildStageStatus" == "\"FAILED\"" ]; then
        notify "Pineline ${pipelineId}" "Failed to build branch ${branchName}" \
            "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=BUILD"
        exit
    fi

    if [ "$buildStageStatus" == "\"SUCCESS\"" ]; then
        notify "Pineline ${pipelineId}" "Builded branch ${branchName}" \
            "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=CANARY"
        buildSuccess=1
        break 1
    fi

    waitForSecs 10
done

if [ "$buildSuccess" != "1" ]; then
    notify "Pineline ${pipelineId}" "Build timeout or failed for branch ${branchName}" \
        "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=BUILD"
    exit
fi

if [ "$toTriggerNotify" == "1" ]; then
    auditNotify "$projectIdentity" "$pipelineId" "$cookie"
fi

auditApproved=0
times=$tryTimes
for i in `seq 1 ${times}`; do
    pinelineAudit=`getPipelineAudit "$projectIdentity" "$pipelineId" "$cookie"`
    echo -e "pinelineAudit: `echo $pinelineAudit | jq` \n"
    checkRespStatusCode "$pinelineAudit"

    auditStatus=`echo $pinelineAudit | jq '.auditStatus'`
    echo -e "auditStatus: $auditStatus \n"

    if [ "$auditStatus" == "\"APPROVED\"" ]; then
        notify "Pineline ${pipelineId}" "Deployed ${stage} for branch ${branchName}" \
            "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
        auditApproved=1
        break 1
    fi

    if [ "$auditStatus" != "\"UNAUDITED\"" ]; then
        notify "Pineline ${pipelineId}" "Failed to audit ${stage} for branch ${branchName}" \
            "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
        exit
    fi

    waitForSecs 10
done

if [ "$auditApproved" != "1" ]; then
    notify "Pineline ${pipelineId}" "Deploy timeout or failed for branch ${branchName}" \
        "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
    exit
fi

if [ "$toTriggerDeploy" == "1" ]; then
    pipelineDetail=`getPipelineDetail "$pipelineId" "$projectIdentity" "$cookie"`
    echo -e "pipelineDetail: `echo $pipelineDetail | jq` \n"
    checkRespStatusCode "$pipelineDetail"

    canaryStageStatus=`echo $pipelineDetail | jq '.stages[] | select(.stage == "CANARY") | .status'`
    echo -e "canaryStageStatus: `echo $canaryStageStatus | jq` \n"

    if [ "$canaryStageStatus" == "\"FAILED\"" ]; then
        notify "Pineline ${pipelineId}" "Failed to deploy ${stage}, no need to re-deploy branch ${branchName}" \
            "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
        exit
    fi

    if [ "$canaryStageStatus" == "\"SUCCESS\"" ]; then
        notify "Pineline ${pipelineId}" "Deployed ${stage}, no need to re-deploy branch ${branchName}" \
            "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
        exit
    fi

    triggerDeploy "$projectIdentity" "$pipelineId" "$stage" "$cookie"
    notify "Pineline ${pipelineId}" "Deploying ${stage} for branch ${branchName}" \
        "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
fi

if [ "$toCheckDeploy" == "1" ]; then
    deploySuccess=0
    times=$tryTimes
    for i in `seq 1 ${times}`; do
        pipelineDetail=`getPipelineDetail "$pipelineId" "$projectIdentity" "$cookie"`
        echo -e "pipelineDetail: `echo $pipelineDetail | jq` \n"
        checkRespStatusCode "$pipelineDetail"

        canaryStageStatus=`echo $pipelineDetail | jq '.stages[] | select(.stage == "CANARY") | .status'`
        echo -e "canaryStageStatus: `echo $canaryStageStatus | jq` \n"

        if [ "$canaryStageStatus" == "\"FAILED\"" ]; then
            notify "Pineline ${pipelineId}" "Failed to deploy ${stage} for branch ${branchName}" \
                "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
            exit
        fi

        if [ "$canaryStageStatus" == "\"SUCCESS\"" ]; then
            notify "Pineline ${pipelineId}" "Deployed ${stage} for branch ${branchName}" \
                "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
            deploySuccess=1
            break 1
        fi

        waitForSecs 10
    done

    if [ "$deploySuccess" != "1" ]; then
        notify "Pineline ${pipelineId}" "Deploy timeout or failed for branch ${branchName}" \
            "https://console.icehe.xyz/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
        exit
    fi
fi

echo
date +"%Y-%m-%d %H:%M:%S %a"
echo -e "============END============ \n"


```
