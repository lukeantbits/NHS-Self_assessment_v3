<div id="nav2" class="nav_bar">
  <ul id = "question_list" style="margin-right:240px;">
    <li><a href="#" class="current" >Q1</a></li>
  </ul>
  <div class="nav_2_right">
    <ul>
      <li><a href="#" id="shift_q_left">◀</a></li>
      <li><a href="#" id="shift_q_right">▶</a></li>
      <li><a href="#" id="add_question">Add</a></li>
      <li><a href="#" id="delete_question">Delete</a></li>
    </ul>
  </div>
  <hr>
  <div style="margin-bottom:5px;"> <strong>question type:</strong>
    <select name="question_type" id="question_type">
    </select>
    &nbsp;<strong>info box:</strong></strong>
    <select name="info_box" id="info_box">
    </select>
    <div class="inline_container" id="info_inner" > <strong>position: </strong>
      <select name="info_box_position" id="info_box_position">
      </select>
      <input style="visibility:visible;" type="button" class="black_button" value="edit info boxes ▶" id="edit_infoboxes"/>
    </div>
  </div>
  <div class="question_actions">
    <div><strong>actions: </strong>
      <select name="q_select_1" id="q_select_1">
        <option value = "null">None</option>
        <option value = "show">show question if</option>
        <option value = "hide">hide question if</option>
      </select>
      <div class="inline_container" id="q_actions_inner">
        <select name="q_select_2" id="q_select_2">
          <option value = "points">points</option>
        </select>
        <select name="q_select_3"  id="q_select_3">
          <option value = "=">=</option>
          <option value = ">">></option>
          <option value = "<"><</option>
        </select>
        <select name="q_select_4"  id="q_select_4">
        </select>
        <input name="q_select_5"  id="q_select_5" value="" style="width:25px;"/>
      </div>
    </div>
  </div>
  <div class="nic_bg" style="width:48%;">
    <textarea id = "question_body" name = "question_body"></textarea>
    <input name="answers" id="answers" type="hidden" value="" />
    <input name="q_id" id="q_id" type="hidden" value="test" />
  </div>
  <div id="quiz">
    <div> <strong>correct answer:</strong><br>
      <input name="quiz_answer" id="quiz_answer" type="text" value="" style="width:48%;"/>
      <br>
      <strong>result summary:</strong><br>
      <div class="nic_bg" style="width:48%;">
        <textarea id = "quiz_summary" name = "quiz_summary"></textarea>
      </div>
    </div>
    <div>
    <strong>check answer copy:</strong><br>
      <div class="nic_bg" style="width:48%;">
        <textarea id = "quiz_check" name = "quiz_check"></textarea>
      </div>
    </div>
  </div>
</div>
