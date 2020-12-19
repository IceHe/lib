# Do Flow

Glossaries

- Inbox : 收集箱
- Task : 任务 - 工作 & 学习
- Thought : 想法, 感悟; 备忘, 笔记
- Question : 问题, 麻烦
- Event : 事件, 日历
- Defer : 推迟
- Delegate : 委托, 委派
- Follow-up : 跟进
- Todo : 待办事项
- Delay : 拖延 / 推迟

## Mine

Version 2020-12-19

**Daily Do Flow**

1.1\. Plan - Filter tasks ( morning )

- Arriving Events? Due events.
- Too many tasks? Over 10 tasks today.

```plantuml
@startuml
start
:Arriving events / tasks / thoughts / questions]
-[#black]-> Collect at once!;
#white:Inbox|
-[#black]-> Clean up;
while (Empty (or too many tasks) ?) is (No)
    if (Valueless?) then (Yes)
        if (Hesitate?) then (Yes)
            #white:Rethink;
            #lightGray:Inbox|
        else (No)
            #white:Discard;
            #lightGray:Trash|
        endif
    else (No)
        if (Task?) then (Yes)
            #white:Task|
        else (No)
            if (Event?) then (Yes)
                #white:Event|
            else (No)
                if (Thought?) then (Yes)
                    #white:Thought|
                else (No)
                    if (Question?) then (Yes)
                        #white:Question|
                    else (No)
                        #orange:What is it?;
                    endif
                endif
            endif
        endif
    endif
endwhile (Yes)
end
@enduml
```

1.2\. Plan - Preprocess tasks ( morning )

- Priority
    - High : Important & urgent
        - _1st Thing 1st_
    - Medium : Important & not urgent
        - _Important_
    - Low : Not important & urgent
        - _Concerned_
    - No : Not important & not urgent
        - _Trash_
- Enough todos? Usually 3 ~ 5 long todos today.
- Valueless? Maybe valueless. ( Doubt )
- Complete soon? Duration <= 2min
- Deferable? Not important and no deadline.
- Delegable? Able to assign to another person.
- Due? With a deadline.
- Splittable? Not specific or duration > 1day.
    - Ideal duration ≈ 2 hours ?

```plantuml
@startuml
start
#white:Task|
-[#black]-> Clean up;
while (Empty (or until enough todos) ?) is (No)
    #white:Categorize;
    #white:Prioritize;
    if (Valueless?) then (Yes)
        if (Hesitate?) then (Yes)
            #white:Rethink;
            #lightGray:Inbox|
        else (No)
            #white:Discard;
            #lightGray:Trash|
        endif
    else (No)
        if (Complete soon?) then (Yes)
            #white:Complete;
            #lightGray:Completed|
        else (No)
            if (Deferable?) then (Yes)
                #white:Defer;
                #lightGray:Defer<
                if (Tomorrow?) then (Yes)
                    #lightGray:Task|
                else (no)
                    #lightGray:Event|
                endif
            else (No)
                if (Delegable?) then (Yes)
                    #white:Delegate;
                    #lightGray:Follow-up<
                    if (Tomorrow?) then (Yes)
                        #lightGray:Task|
                    else (no)
                        #lightGray:Event|
                    endif
                else (No)
                    if (Due?) then (Yes)
                        #white:Set deadline\n and duration;
                    else (No)
                        if (Splittable?) then (Yes)
                            #white:Split into\nsubtasks;
                            'note right : SMART 法则
                            #lightGray:Task|
                        else (No)
                            #white:Todo|
                        endif
                    endif
                endif
            endif
        endif
    endif
endwhile (Yes)
end
@enduml
```

2\. Do tasks

- Block? Encounter a problem.
- Timeout? Over expected duration or till end of day.
- Finish soon? Extra duration < 1h or till end of day.
- Valueless? Maybe valueless. ( Doubt )

```plantuml
@startuml
start
#white:Todo|
#white:Sort by due;
#white:Sort by priority;
-[#black]-> Clean up;
while (Empty (and till end of day) ?) is (No)
    #white:1st thing 1st;
    #lightGray:WIP<
    if (Complete?) then (Yes)
        #white:Complete;
        #lightGray:Completed|
    else (No)
        if (Block?) then (Yes)
            #white:Rethink;
            #lightGray:Block<
            #lightGray:Task|
        else (No)
            if (Timeout?) then (Yes)
                if (Finish soon?) then (Yes)
                    #white:Continue;
                else (No)
                #white:Rethink;
                #lightGray:Defer<
                if (Tomorrow?) then (Yes)
                    #lightGray:Todo|
                else (no)
                    #lightGray:Event|
                endif
                endif
            else (No)
                if (Valueless?) then (Yes)
                    #white:Discard;
                    #lightGray:Trash|
                else (No)
                    #white:Rethink;
                    #lightGray:Defer<
                    if (Tomorrow?) then (Yes)
                        #lightGray:Todo|
                    else (no)
                        #lightGray:Event|
                    endif
                endif
            endif
        endif
    endif
    #lightGray:Untag WIP<
endwhile (Yes)
end
@enduml
```

3\. Check done tasks ( evening )

- Valueless? Maybe valueless.
- Redo? Need to redo. (Poor quality?)
- Reflect?
    - _A. Add to Inbox, Thought & Question_
    - _B. Update its description or insert a new comment?_
    - _C. Write in reflect.md of IceHe's Library_
    - …

```plantuml
@startuml
start
#white:Completed (and Trash?)|
-[#black]-> Clean up;
while (Checked all (and till end of day) ?) is (No)
    fork
        if (Redo?) then (Yes)
            #white:Redo;
            #lightGray:Task|
        endif
    fork again
        if (No thought or question?) then (Yes)
            if (Value?) then (Great job)
            else (Valueless)
            endif
            if (Long duration?) then (Reasonable)
            else (Time wasted)
            endif
            #white:Reflect;
            :New events / tasks / thoughts / questions?]
        else (No)
            if (Need archives?) then (Yes)
                #white:Do nothing;
            else (No)
                if (Completed?) then (Yes)
                    #white:Discard;
                    #lightGray:Trash|
                else (No)
                    #yellow:Delete Forever;
                endif
            endif
        endif
    end fork
endwhile (Yes)
end
@enduml
```

4\. Adjust

- Update rehabilitation.md
    - 细则 → GTD

## References

Original

![GTD](_images/gtd.jpg)

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
