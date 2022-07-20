# Bash Script - Example 4

---

Prepare

-   on macOS

```bash
brew install terminal-notifier
```

File : auto-check-deploy-production.sh

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
        --location "https://infra-api.icehe.life/infra-phoenix-console/api/pipeline/icehe-xyz-project?branchName=${branchName}&page=0&authorName=${authorName}" \
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
        --location "https://infra-api.icehe.life/infra-phoenix-console/api/pipeline/detail/v2/${pipelineId}/${projectIdentity}" \
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
        --location "https://infra-api.icehe.life/infra-phoenix-console/api/action/triggerBuild?projectIdentity=${projectIdentity}&branch=${branchName}" \
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
        --location "https://infra-api.icehe.life/infra-phoenix-console/api/action/triggerDeployment?projectIdentity=${projectIdentity}&pipelineId=${pipelineId}&stage=${stage}" \
        --request POST \
        --header "${cookie}"
    echo
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
stage=PRODUCTION
tryTimes=360

echo -e "PWD: `pwd`"
echo -e "PATH: $PATH"
echo -e "authorName: $authorName"
echo -e "branchName: $branchName"
echo -e "cookie: $cookie"
echo -e "projectIdentity: $projectIdentity"
echo -e "stage: $stage"
echo -e "tryTimes: $tryTimes"
echo

if [ "$authorName" == "" ]; then
    notify "Pineline" "Do nothing for invalid authorName"
    exit
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
        "https://console.icehe.life/#/management/projects/${projectIdentity}/pipelines/?branch=${branchName}&page=0"
    exit
fi

buildSuccess=0
times=$tryTimes
for i in `seq 1 ${times}`; do
    pipelineDetail=`getPipelineDetail "$pipelineId" "$projectIdentity" "$cookie"`
    echo -e "pipelineDetail: `echo $pipelineDetail | jq` \n"
    checkRespStatusCode "$pipelineDetail"

    productionStageStatus=`echo ${pipelineDetail} | jq '.stages[] | select(.stage == "PRODUCTION") | .status'`
    echo -e "productionStageStatus: `echo $productionStageStatus | jq` \n"

    if [ "$productionStageStatus" == "\"FAILED\"" ]; then
        notify "Pineline ${pipelineId}" "Failed to deploy branch ${branchName}" \
            "https://console.icehe.life/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
        exit
    fi

    if [ "$productionStageStatus" == "\"SUCCESS\"" ]; then
        notify "Pineline ${pipelineId}" "Deployed branch ${branchName}" \
            "https://console.icehe.life/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
        buildSuccess=1
        break 1
    fi

    waitForSecs 10
done

if [ "$buildSuccess" != "1" ]; then
    notify "Pineline ${pipelineId}" "Deploy timeout or failed for branch ${branchName}" \
        "https://console.icehe.life/#/management/projects/${projectIdentity}/pipelines/${pipelineId}?stage=${stage}"
    exit
fi

echo
date +"%Y-%m-%d %H:%M:%S %a"
echo -e "============END============ \n"

```
