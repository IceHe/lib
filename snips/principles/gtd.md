# Do Flow

Glossaries

- Task : 任务 - 工作 & 学习
- Thought : 想法, 感悟
- Memo : 备忘, 信息, 笔记
- Inbox : 收集箱
- Delay : 拖延 / 推迟
- Defer : 推迟
- Delegate : 委托, 委派
- Todo : 待办事项
- Follow-up : 跟进

## Plan

```plantuml
@startuml
start
:Task / Thought / Memo]
-[#black]-> Collect at once!;
#white:Inbox|
-[#black]-> Clean up;
while (Empty?) is (No)
    if (**Have to do?**) then (No)
        #white:Quitted;
    else (Yes)
        if (**Finish in 2 min?**) then (Yes)
            #white:Just do it.;
        else (No)
            if (Allow to defer?) then (Yes)
                #white:Deferred;
            else (No)
                if (Allow to delegate?) then (Yes)
                    #white:Delegated;
                else (No)
                    if (Should split up?) then (Yes)
                        #white:Split up;
                        note right : SMART 法则
                        #white:Inbox|
                    else (No)
                        #white:Todo|
                        if (Fixed-term?) then (Yes)
                            #white:Due time;
                        else (No)
                        endif
                        #white:Sort by\npriority;
                    endif
                endif
            endif
        endif
    endif
endwhile (Yes)
end
@enduml
```

## Action

```plantuml
@startuml
start
#white:Todo|
if (What is it?) then (Problem)
    #white:Thinking;
    note right : What Why How\n/ 集中 / 通勤 \n/ 散步 / 休憩
else (Action)
    #white:Doing;
    note right : 早上全力以赴\n做最重要的一件事!
    if (Problems found?) then (No)
        #white:Logging;
        note right : STAR 法则
        end
    else (Yes)
    endif
endif
        #white:Inbox|
        stop
@enduml
```

## Reflect

```plantuml
@startuml
start
fork
    #paleGreen:Inbox|
fork again
    #aqua:Todo|
end fork
:Reflect & Improve & Plan;
note right : STAR Principle
fork
    fork
        #lightGray:Meaningless]
    fork again
        #deepSkyBlue:Done|
    end fork
    #white:Archived;
fork again
    fork
        #orange:WIP|
    fork again
        #crimson:Redo<
    end fork
    #paleGreen:Inbox|
end fork
stop
@enduml
```

## References

### Original

![GTD](_images/gtd.jpg)

### Flow Chart

```plantuml
@startuml
start
:任务 / 感想 / 备忘]
-[#black]-> 立即记录;
#paleGreen:收集箱|
-[#black]-> 逐项思考;
if (能否在 2 min 内解决 ?) then (能)
    #white:立即去做!;
    stop
else (否)
    if (不做会不会死 ?) then (不会)
        #white:果断舍弃;
        end
    else (会)
        if (能否拖延或推迟) then (能)
            #paleGreen:收集箱|
            stop
        else (否)
            if (能否委托别人做 ?) then (能)
                #lightGray:跟进清单|
                #white:委托别人;
                end
            else (否)
                :一定要做]
                if (固定时间的事件 ?) then (是)
                    #turquoise:日历|
                    stop
                else (否)
                    #plum:任务清单|
                    stop
                endif
            endif
        endif
    endif
endif
@enduml
```

```plantuml
@startuml
start
#plum:任务清单|
if (问题还是行动 ?) then (问题)
    #aqua:思考清单|
    :碎片时间 : \n通勤 / 散步 / 休憩;
    stop
else (行动)
    #gold:待办清单|
    :选择;
    #white:最重要的一件事\n全力以赴去做 !;
    note right : 每天早上
    fork
        :遭遇的问题]
        -[#black]-> 记入;
        #aqua:思考清单|
    fork again
        :重要信息]
        -[#black]-> 记入;
        #honeyDew:工作日志|
    end fork
    :反省 / 改进 / 计划;
    stop
endif
@enduml
```
