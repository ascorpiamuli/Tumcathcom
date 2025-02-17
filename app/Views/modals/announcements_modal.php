<!-- Announcement Modal -->
<div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="announcementModalLabel">Post an Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?=site_url('admin/admin_announcements')?>">
          <div class="mb-3">
            <label for="announcementTitle" class="form-label">Title</label>
            <input type="text" class="form-control"placeholder="Announcement Title" id="announcementTitle" name="announcement_title" required>
          </div>
          <div class="mb-3">
            <label for="announcementContent" class="form-label">Content</label>
            <textarea class="form-control" placeholder="Max 150 Words" id="announcementContent" name="announcement_content" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Post Announcement</button>
        </form>
      </div>
    </div>
  </div>
</div>