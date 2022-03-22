<div role="tabpanel" class="tab-pane" id="services">
<button href="#myModal" id="openBtn" data-toggle="modal" class="btn btn-default">Modal</button>

<div class="modal fade" id="myModal">
<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Big Title</h3>
        </div>
        <div class="modal-body">
		  <h5 class="text-center">Hello. Some text here.</h5>
          <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th>Location</th>
                <th>Points</th>
                <th class="text-right">Mean</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Long Island, NY, USA</td>
                <td>3</td>
                <td class="text-right">45001</td>
              </tr>
              <tr><td>Chicago, Illinois, USA</td>
                <td>5</td>
                <td class="text-right">76455</td>
              </tr>
              <tr><td>New York, New York, USA</td>
                <td>10</td>
                <td class="text-right">39097</td>
              </tr>
            </tbody>
          </table>
          <div class="form-group">
            <input type="button" class="btn btn-warning btn-sm pull-right" value="Reset">
            <div class="clearfix"></div>
          </div>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div>
				
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>