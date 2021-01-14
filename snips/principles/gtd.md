# GTD Flow

GTD Flow + PDCA Cycle + SMART Principle

---

## Simple Flow

```plantuml
@startuml
start
:Task / Thought / Memo]
-[#black]-> Collect;
#white:Inbox|
-[#black]-> Do;
while (Empty?) is (No)
    #white:Categorize;
    #white:Prioritize;
    if (**Have to do?**) then (No)
        #lightGray:Trash|
    else (Yes)
        if (**Finish in 2 min?**) then (Yes)
            #white:Done|
        else (No)
            if (Allow to defer?) then (Yes)
                #white:Inbox|
            else (No)
                if (Allow to delegate?) then (Yes)
                    #white:Follow-up|
                else (No)
                    if (  Should split up?) then (Yes)
                        #white:Split into\nsubtasks;
                        note right : SMART 法则
                        #white:Inbox|
                    else (No)
                        #white:Set due time;
                        if (Fixed-term?) then (Yes)
                            #white:Calendar|
                        else (No)
                            #white:Todo|
                        endif
                        #white:Sort by due time;
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

## Daily Flow

每日流程

### Collect

0\. Collect tasks and anything else

_( anytime )_

- Arriving Events? Due events.

```plantuml
@startuml
start
:Tasks / arriving events / others]
-[#black]-> Collect;
#white:Inbox|
end
@enduml
```

### Filter

1.1\. Plan - Filter tasks

_( night or morning )_

-   Why include Today and Next 7 Days List?

    Check arriving events ( which are not in Task & Todo List ).

-   Checked all? Or too many tasks.

    Too many tasks: Total duration over available time today.

-   Event: Events, future tasks ( without tomorrow ) .

-   Others: Thoughts, questions and something else.

```plantuml
@startuml
start
#white:Inbox / Today / Next 7 Days List|
while (Checked all?) is (No)
    if (Valueless?) then (Yes)
        if (Hesitate?) then (Yes)
            #white:Inbox|
        else (No)
            #lightGray:Trash|
        endif
    else (No)
        if (Task?) then (Yes)
            #white:Task|
        else (No)
            if (Event?) then (Yes)
                #white:Event|
            else (No)
                #white:Others|
            endif
        endif
    endif
endwhile (Yes)
end
@enduml
```

### Prepare

1.2\. Plan - Prepare tasks

_( night or morning )_

-   Categorize:

    Work / Learn / Think / Read / Zheteng / Fun / Rest / Sport / Have-to / Waste / …

-   Priority

    - High: Important & urgent - _1st Thing 1st_
    - Medium: Important & not urgent - _Important_
    - Low: Not important & urgent - _Concerned_
    - No: Not important & not urgent - _Trash_

-   Deferrable? Not important.

-   Splittable? Not specific or duration > 2h.

    Ideal duration <= 2 hours

-   Split: Split into subtasks

```plantuml
@startuml
start
#white:Task|
while (Checked all?) is (No)
    #white:Categorize;
    #white:Prioritize;
    if (Valueless?) then (Yes)
        if (Hesitate?) then (Yes)
            #white:Inbox|
        else (No)
            #lightGray:Trash|
        endif
    else (No)
        #white:Set due date;
        if (Deferrable?) then (Yes)
            #white:Defer<
            if (Tomorrow?) then (Yes)
                #white:Task|
            else (No)
                #white:Event|
            endif
        else (No)
            if (Splittable?) then (Yes)
                #white:Split;
                #white:Task|
            else (No)
                #white:Todo|
                'note right: SMART 法则
            endif
        endif
    endif
endwhile (Yes)
end
@enduml
```

### Select

2.1\. Do - Select 1st task

_( morning, noon, afternoon, evening )_

-   Checked all? Or too many todos.

    Too many todos: Total duration over available time today.

-   Complete soon? Estimated duration <= 5min.

-   Delegable? Able to assign to another person.

```plantuml
@startuml
start
#white:Todo|
#white:Untag WIP<
while (Found 1st thing?) is (No)
    if (Complete soon?) then (Yes)
        #white:Soon<
        if (Completed soon?) then (Yes)
            #white:Completed|
        else (No)
            #white:Defer<
            if (Tomorrow?) then (Yes)
                #white:Task|
            else (No)
                #white:Event|
            endif
            '果断放弃, 不要再浪费时间进去
        endif
    else (No)
        if (Delegable?) then (Yes)
            #white:Delegate;
            #white:Follow-up<
            if (Tomorrow?) then (Yes)
                #white:Task|
            else (no)
                #white:Event|
            endif
        else (No)
            #white:Sort by due date;
            #white:Sort by priority;
        endif
    endif
endwhile (Yes)
#white:Work In Process<
end
@enduml
```

### Doing

2.2\. Do - Doing 1st task

_( morning, noon, afternoon, evening )_

- Block? Encounter a problem.
- Timeout? Over expected duration or till end of day.
- Finish soon? Extra duration < 1h or till end of day.

```plantuml
@startuml
start
#white:Work In Process<
while (Completed?) is (No)
    if (Block?) then (Yes)
        #white:Block<
        #white:Task|
        #white:Select \n1st task;
        end
    else (No)
        if (Timeout?) then (Yes)
            if (Deadline?) then (Yes)
                #white:Continue;
            else (No)
                #white:Defer<
                if (Tomorrow?) then (Yes)
                    #white:Task|
                else (no)
                    #white:Event|
                endif
                #white:Select \n1st task;
                end
            endif
        else (No)
            if (Valueless?) then (Yes)
                if (Hesitate?) then (Yes)
                    #white:Defer<
                    if (Tomorrow?) then (Yes)
                        #white:Task|
                    else (no)
                        #white:Event|
                    endif
                else (No)
                    #lightGray:Trash|
                endif
            else (No)
                #orange:What's the\n problem?;
            endif
            #white:Select \n1st task;
            end
        endif
    endif
    '#lightGray:Untag WIP<
endwhile (Yes)
#white:Completed|
end
@enduml
```

### Reflect

3\. Check - Reflect done tasks

_( night or morning )_

- Checked all? Or till end of day.
- Redo? Need to redo. _( Poor quality? )_
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
while (Checked all?) is (No)
    fork
        if (Redo?) then (Yes)
            #white:Inbox|
            '#white:Redo;
            '#lightGray:Task|
        else (No)
        endif
    fork again
        if (Valueless?) then (Yes)
        else (No)
        endif
        if (Time-wasted?) then (Yes)
        else (No)
        endif
        :New tasks \n/ events / others?]
    fork again
        if (Archive?) then (Yes)
            #white:Skip;
        else (No)
            if (Trash?) then (Yes)
                #yellow:Delete;
            else (No)
                #lightGray:Trash|
            endif
        endif
    end fork
endwhile (Yes)
end
@enduml
```

### Improve

4\. Act / Adjust - Improve daily flow

- Update regulations in rehabilitation.md

## References

### Original

![GTD](_images/gtd.jpg)

### Rewritten

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
