<style>
.file-card-list { }
.file-card-row {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 16px 24px;
  border-bottom: 1px solid var(--border-light);
  transition: background 0.15s;
}
.file-card-row:last-child { border-bottom: none; }
.file-card-row:hover { background: var(--bg-section-alt); }
.file-icon-wrap {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.file-card-name {
  font-size: 14.5px;
  font-weight: 600;
  color: var(--navy);
  flex: 1;
  min-width: 0;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.file-type-badge {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 0.6px;
  padding: 3px 9px;
  border-radius: 4px;
  flex-shrink: 0;
}
.file-action-btn {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 13px;
  font-weight: 600;
  padding: 7px 16px;
  border-radius: var(--radius-md);
  text-decoration: none;
  flex-shrink: 0;
  transition: background 0.15s, color 0.15s;
}
.file-action-btn:hover { text-decoration: none; }
</style>

@if($chapter->resources->isEmpty())
  <div style="text-align:center;padding:56px 24px;color:#9ca3af;">
    <i class="bi bi-folder2-open" style="font-size:2.8rem;display:block;margin-bottom:14px;color:#d1d5db;"></i>
    <p style="font-size:14px;margin:0;">No files uploaded yet. Check back soon.</p>
  </div>
@else
  <div class="file-card-list">
    @foreach($chapter->resources as $resource)
      @php
        $isPdf = str_contains($resource->file_type, 'pdf');
      @endphp
      <div class="file-card-row">
        <span class="file-icon-wrap" style="{{ $isPdf ? 'background:rgba(220,38,38,0.08);color:#dc2626;' : 'background:rgba(29,78,216,0.08);color:#1d4ed8;' }}">
          <i class="bi {{ $isPdf ? 'bi-file-earmark-pdf-fill' : 'bi-file-earmark-word-fill' }}"></i>
        </span>

        <span class="file-card-name" title="{{ $resource->file_name }}">{{ $resource->file_name }}</span>

        <span class="file-type-badge" style="{{ $isPdf ? 'background:#fee2e2;color:#dc2626;' : 'background:#dbeafe;color:#1d4ed8;' }}">
          {{ $isPdf ? 'PDF' : 'DOC' }}
        </span>

        @if($isPdf)
          <a href="{{ route('members.chapters.view', $resource->id) }}"
             target="_blank"
             class="file-action-btn"
             style="background:var(--navy);color:#fff;">
            <i class="bi bi-eye"></i> View
          </a>
        @else
          <a href="{{ route('members.chapters.download', $resource->id) }}"
             class="file-action-btn"
             style="background:var(--bg-section-alt);color:var(--navy);border:1px solid var(--border-light);">
            <i class="bi bi-download"></i> Download
          </a>
        @endif
      </div>
    @endforeach
  </div>
@endif
