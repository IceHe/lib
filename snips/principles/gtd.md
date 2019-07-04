# Do Flow

## Intro

```plantuml
@startuml

cloud todo as "Task / Thought / Memo"
database inbox as "Inbox"
rectangle do as "What to do? \nHow to do?"

todo --> inbox
inbox --> do

@enduml
```

### Glossary

- Task : 任务 - 工作 & 学习
- Thought : 想法, 感悟
- Memo : 备忘, 信息, 笔记
- Inbox : 收集箱
- Delay : 拖延 / 推迟
- Defer : 推迟
- Delegate : 委托, 委派
- Todo : 待办事项
- Follow-up : 跟进

### Sample

> PlantUML

```plantuml
@startuml
@enduml
```

## Plan

### Ver 0

Policy

- 如无必要, 勿增实体. 例如, 可以推断出来的节点, 就别画蛇添足了.

```plantuml
@startuml
start
:Task / Thought / Memo]
-[#black]-> Record at once!;
#paleGreen:Inbox|
-[#black]-> Decide one by one.;
if (Finish in 2 min?) then (Yes)
    #white:Do now!;
    end
else (No)
    if (Have to do?) then (No)
        #white:Quit now!;
        end
    else (Yes)
        if (Allow to delay?) then (Yes)
            #paleGreen:Inbox|
            stop
        else (No)
            if (Allow to delegate?) then (Yes)
                if (Have to follow up?) then (Yes)
                    #lavender:Follow-Up|
                    stop
                else (No)
                    #lightGray:Ignore;
                    end
                endif
            else (No)
                if (Is it fixed-term?) then (Yes)
                    #pink:Calendar|
                    stop
                else (No)
                    #aqua:Todo|
                    stop
                endif
            endif
        endif
    endif
endif
@enduml
```

### Ver 1

Policy

- 没有必要做的事情, 就算用一两分钟去做, 也是浪费!
    - Pull up section "Have to do?"
- 由于现在还处于比较低的地位, 很少有可以将自己事情委派给他人的机会和权力.
    - Simplify section "Allow to delegate?"
- 其它
    - 突出重点 : 部分 "条件分支" **加粗** 显示
    - 简化列表 : 不使用 "Calendar" List, 改用 "设置 Due Date" 的方式表示
    - 优化用词

```plantuml
@startuml
start
:Task / Thought / Memo]
-[#black]-> Record at once!;
#paleGreen:Inbox|
-[#black]-> Decide step by step.;
if (**Have to do?**) then (No)
    #white:Quit now!;
    end
else (Yes)
    if (**Finish in 2 min?**) then (Yes)
        #white:Do now!;
        #deepSkyBlue:Done|
        end
    else (No)
        if (Allow to delay?) then (Yes)
            #paleGreen:Inbox|
            stop
        else (No)
            if (Allow to delegate?) then (Yes)
                #gray:Delegate;
                #deepSkyBlue:Done|
                end
            else (No)
                #aqua:Todo|
                if (Is it fixed-term?) then (Yes)
                    #white:Due dated;
                endif
                stop
            endif
        endif
    endif
endif
@enduml
```

### Ver 2

Policy

- 一两分钟就做完的杂事, 通常没啥意义, 没必要挪到到 Done 去.
    - 挪到 Done List 只该是 "有意义" 的任务成就!
        - 列出已完成的没意义的小事, 来提升自己的满足感? 太没出息.
        - 除非状态太差了, 需要自我激励; 否则尽量别这么做了……
    - 直接归档 ( Archived ) , 当然最好删除 ( Removed )
- 部分步骤从 Action 阶段前移到 Plan 阶段
    - Split up
    - Sort by
- 其它 : 优化描述

```plantuml
@startuml
start
:Task / Thought / Memo]
-[#black]-> Collect at once!;
#paleGreen:Inbox|
-[#black]-> Once a day.;
while (Empty?) is (No)
    if (**Have to do?**) then (No)
        #white:Quited;
    else (Yes)
        if (**Finish in 2 min?**) then (Yes)
            #white:Done;
        else (No)
            if (Allow to defer?) then (Yes)
                #yellow:Deferred|
            else (No)
                if (Allow to delegate?) then (Yes)
                    #lightGray:Delegated;
                else (No)
                    if (  Should split up?) then (Yes)
                        #white:Split up;
                        #paleGreen:Inbox|
                    else (No)
                        if (Fixed-term?) then (Yes)
                            #pink:Calendar|
                        else (No)
                            #aqua:Todo|
                        endif
                        #white:Sort by priority;
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
fork
    #pink:Calendar|
fork again
    #aqua:Todo|
end fork
if (What is it actually?) then (Problem)
    #plum:Thinking|
    #white:What & Why & How\n集中 / 通勤 / 散步 / 休憩;
    'note right : What & Why & How
    #paleGreen:Inbox|
    stop
else (Action)
    #orange:WIP|
    #white:Just do it.;
    note right : 每天早上全力以赴\n去做最重要的一件事!
    if (Problems found?) then (Yes)
        :Problems]
        #paleGreen:Inbox|
        stop
    else (No)
        :Logs]
        #deepSkyBlue:Done|
        note right : STAR Principle
        end
    endif
endif
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
        #lightBlue:Redo<
    end fork
    #paleGreen:Inbox|
end fork
stop
@enduml
```

# References

## Original

> Image

![GTD](_images/gtd.jpg)

## Rewritten

> Flow Chart - PlantUML

```plantuml
@startuml
start
:任务 / 感想 / 备忘]
-[#black]-> 立即记录;
#paleGreen:收集箱|
-[#black]-> 逐项思考;
if (能否在 2 min 内解决 ?) then (能)
    #white:立即去做 !;
    stop
else (否)
    if (不做会不会死 ?) then (不会)
        #white:果断舍弃.;
        end
    else (会)
        if (能否拖延或推迟) then (能)
            #paleGreen:收集箱|
            stop
        else (否)
            if (能否委托别人做 ?) then (能)
                #lightGray:跟进清单|
                #white:委托别人.;
                end
            else (否)
                :一定要做]
                if (有固定时间吗 ?) then (有)
                    #turquoise:日历|
                    stop
                else (没有)
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
